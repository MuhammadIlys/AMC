@extends('users.qbank_user.qbank_exam.templates.main')
@section('main-container')

 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Sweet Alert css-->
  <link href="https://uworld.aceamcq.com/Themes/themeone/assets/uw_assets/default/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">


 <!-- Bootstrap Bundle (includes Popper.js) -->
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

 <!-- jQuery UI -->
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

 <!-- Include Interact.js (for touch-based interaction) -->
 <script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.12/dist/interact.min.js"></script>


 <style>

.nav-tab-color {
    background-color: #5590CC !important;
    color:white;
}

.nav-tab-color a{

    color:#fff !important;


}

.questionmarked,
.questionnotes {
    background-repeat: no-repeat;
    background-position: 50%;
    vertical-align: middle;
    display: inline-block;
}

.questionmarked {
    background-image: url('{{ url("sitelogo/flag.png") }}');
    height: 10px;
    width: 30px;
}

.questionnotes {
    background-image: url('{{ url("sitelogo/annotateIconTrans.png") }}');
    height: 13px;
    width: 30px;
}

.highlight {
      background-color: yellow;
      transition: background-color 0.3s;
}

.swal2-close:focus{

    box-shadow: none !important;
}


 </style>

  <script>

     // Retrieve questions from localStorage
     var questionsData;

    // Retrieve questions from localStorage

    var currentQuestionIndex = 0;
    var totalQuestions ;
    var testMode='{{ $test_mode }}';
    var questionMode='{{ $question_mode }}';


    $(document).ready(function () {



        $('#card-border').hide();
        $('#hide-explanation').hide();


            var countdown;

            // Function to start the countdown timer
            function startTimer() {
                // Retrieve remaining time from localStorage or set to default (3600 seconds = 1 hour)
                countdown = localStorage.getItem('timer') || 3600;

                // Update timer every second
                var interval = setInterval(function () {
                    var hours = Math.floor(countdown / 3600);
                    var minutes = Math.floor((countdown % 3600) / 60);
                    var seconds = countdown % 60;

                    // Display the remaining time
                    $('#test_timing').text('Time:  '+pad(hours) + ':' + pad(minutes) + ':' + pad(seconds));

                    // Save remaining time to localStorage every second
                    localStorage.setItem('timer', countdown);

                    // Check if the time has reached zero
                    if (--countdown < 0) {
                        clearInterval(interval);
                        timerEnded();
                    }
                }, 1000);
            }

            // Function to pad single-digit numbers with leading zeros
            function pad(val) {
                var valString = val + "";
                return valString.length < 2 ? "0" + valString : valString;
            }

            function timerEnded() {
                // Add your logic to handle what happens when the time is up
                alert('Time is up!');  // You can replace this with your own actions
            }

            function handleTestMode() {
                // Check if testMode is set to 'toggleTimed' in localStorage
                if (testMode === 'toggleTimed') {
                    // Start the timer and keep the interval ID for possible future use
                    startTimer();
                } else {
                    // Hide the time element if the condition is not met
                    $('#test_timing').hide();
                }
            }

            handleTestMode();









    });





// Function to generate a random number between min and max (inclusive)
function generateRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Function to get correct option text
function getCorrectOptionText(correctOption) {
    var optionIndex = parseInt(correctOption) - 1;
    var optionLetters = ['A', 'B', 'C', 'D', 'E'];
    return optionLetters[optionIndex];
}

// Function to load the next question
function loadNextQuestion() {



    if (currentQuestionIndex < totalQuestions - 1) {
        // Increment the current question index and load the question
        loadQuestionByIndex(currentQuestionIndex + 1);
    }
}

// Function to load the previous question
function loadPreviousQuestion() {


    if (currentQuestionIndex > 0) {
        // Decrement the current question index and load the question
        loadQuestionByIndex(currentQuestionIndex - 1);

    }
}

// Function to load a question by its index
function loadQuestionByIndex(index) {

    var randomNumber = generateRandomNumber(30, 100);
    $('#correct-ans-per').text(randomNumber + '%');
    $('#card-border').hide();
    $('#hide-explanation').hide();
    $('input[name="radio-group"]').prop('disabled', false);

    if (index >= 0 && index < totalQuestions) {
        var question = questionsData[index];

        // Update the content in the specified elements with question details
        $('#question-text').html(question.question_text);
        $('#option-1').text(question.option1 || '');
        $('#option-2').text(question.option2 || '');
        $('#option-3').text(question.option3 || '');
        $('#option-4').text(question.option4 || '');
        $('#option-5').text(question.option5 || '');

        var correctOptionText = getCorrectOptionText(question.correct_option);
        $('#correct-option').text(correctOptionText);
        $('#correction-option-text').css('color', 'green').text('Correct Option');
        $('#card-border').css('border-left', '5px solid green');

        $('#question-explanation').html('');
        // Update the question explanation as plain text
        $('#question-explanation').html(question.question_explanation);
        $('#question-id').text(question.qbank_question_id);

        highlightAllText(question.qbank_question_id);

        storeRadioButtonState();

        // Update the current question index
        currentQuestionIndex = index;



        // Update the question links with the highlighted class
        updateQuestionLinks(index);

        var ischecked5 = localStorage.getItem('questionMarkChecked_' + questionsData[currentQuestionIndex].qbank_question_id);

        if (ischecked5 === 'true') {

            $('#question_mark').prop('checked', true);
        }else{
            $('#question_mark').prop('checked', false);

        }


        // Hide radio buttons for empty options
        for (var i = 1; i <= 5; i++) {
            var radioId = '#test' + i;

            if ($('#option-' + i).text().trim() === '') {
                $(radioId).parent().parent().hide();
            } else {
                $(radioId).parent().parent().show();
            }
        }

        // Clear previous radio button state
        $('input[name="radio-group"]').prop('checked', false);

        // Restore the state of radio buttons from local storage if the question ID matches
        var storedOption = localStorage.getItem('selectedOption_' + question.qbank_question_id);
        var storedRadioId = localStorage.getItem('radioId_' + question.qbank_question_id);

        if (storedOption !== null && storedRadioId !== null) {
            $('#' + storedRadioId).prop('checked', true);
            $('input[name="radio-group"]').prop('disabled', true);

            if (testMode === 'toggleTimed') {
                $('#card-border').hide();
                $('#hide-explanation').hide();
            } else {
                $('#card-border').show();
                $('#hide-explanation').show();
            }



        }


    }


}


// Function to update the question links
function updateQuestionLinks(selectedIndex) {
    var questionsHtml = '';

    questionsData.forEach(function (question, index) {

        var questionMarkSpan = '<span class="questionmarked marked' + questionsData[index].qbank_question_id + ' ng-star-inserted"></span>';
        var ischecked = localStorage.getItem('questionMarkChecked_' + questionsData[index].qbank_question_id);

        var questionNoteSpan = '<span class="questionnotes marked' + questionsData[index].qbank_question_id + ' ng-star-inserted"></span>';
        var ischecked2 = localStorage.getItem('questionNoteChecked_' + questionsData[index].qbank_question_id);

        var questionNumber = index + 1;

        // Add the class "nav-tab-color" to the current question link
        var listItemClass = index === selectedIndex ? 'nav-tab-color' : '';

        // Assume index is the variable representing the current index in your loop
        var backgroundStyle = index % 2 === 0 ? 'background-color: #EFEFEF;' : '';

        questionsHtml += `<li style="width: 100%;${backgroundStyle}" class="nav-item ${listItemClass}">
        <a href="#" class="nav-link" onclick="loadQuestionByIndex(${index})">${questionNumber}`;

        if (ischecked === 'true') {
            // Add or remove the span to/from the question link
            questionsHtml += `<span data-qbank-question-id="${questionsData[index].qbank_question_id}" class="questionmarked marked${questionsData[index].qbank_question_id} ng-star-inserted"></span>`;
            // Update the checkbox state
            $('#question_mark').prop('checked', true);
        } else {
            $(`a.nav-link span.marked${questionsData[index].qbank_question_id}`).remove();
            $('#question_mark').prop('checked', false);
        }


        if (ischecked2 === 'true') {
            // Add or remove the span to/from the question link
            questionsHtml += `<span data-qbank-question-id="${questionsData[index].qbank_question_id}" class="questionnotes marked2${questionsData[index].qbank_question_id} ng-star-inserted"></span>`;

        } else {
            $(`a.nav-link span.marked2${questionsData[index].qbank_question_id}`).remove();

        }


        questionsHtml += `</a></li>`;



    });

    // Display the questions links in the container
    $('#navbar-nav').html(questionsHtml);

    // Update the current question number and total number of questions
    $('#current-question-no').text(selectedIndex + 1);
    $('#total-question-no').text(totalQuestions);
}


// Function to handle storing the state of radio buttons in local storage
function storeRadioButtonState() {
    var selectedOption = $('input[name="radio-group"]:checked').val();
    var radioId = $('input[name="radio-group"]:checked').attr('id');



    if (selectedOption !== undefined) {
        localStorage.setItem('selectedOption_' + questionsData[currentQuestionIndex].qbank_question_id, selectedOption);
        localStorage.setItem('radioId_' + questionsData[currentQuestionIndex].qbank_question_id, radioId);
        localStorage.setItem('currentQuestionIndex', currentQuestionIndex);

    }
}





    function handleCheckboxChange(checkbox) {

        var questionMarkSpan = '<span class="questionmarked marked' + questionsData[currentQuestionIndex].qbank_question_id + ' ng-star-inserted"></span>';

        // Add your custom event handling logic here
        if (checkbox.checked) {
            // Add the span to the question link
            $('a.nav-link').eq(currentQuestionIndex).append(questionMarkSpan);
            localStorage.setItem('questionMarkChecked_'+ questionsData[currentQuestionIndex].qbank_question_id, 'true');
        } else {
            // Remove the span from the question link
            $('a.nav-link span.marked' + questionsData[currentQuestionIndex].qbank_question_id).remove();
            localStorage.setItem('questionMarkChecked_'+ questionsData[currentQuestionIndex].qbank_question_id, 'false');
        }
    }






// Function to be called on page load
$(document).ready(function () {

    var result={!! $questions !!} ;

    var questions2=JSON.stringify(result);

    questionsData=JSON.parse(questions2);

    if( questionsData !== null &&  questionsData.length !== 0){

        totalQuestions=questionsData.length;

    }


    // Check if the current question index exists in sessionStorage and restore it
    var storedIndex = localStorage.getItem('currentQuestionIndex');
    if (storedIndex !== null) {
        currentQuestionIndex = parseInt(storedIndex);
    }else{

        currentQuestionIndex =0;
    }

   // Check if handleDatabaseNotes has already been executed
    if (!localStorage.getItem('handleDatabaseNotesExecuted')) {
        // Execute handleDatabaseNotes
        handleDatabaseNotes();

        // Set the flag in localStorage to indicate that handleDatabaseNotes has been executed
        localStorage.setItem('handleDatabaseNotesExecuted', 'true');
    }

    // Check if handleDatabaseMarked has already been executed
    if (!localStorage.getItem('handleDatabaseMarkedExecuted')) {
        // Execute handleDatabaseMarked
        handleDatabaseMarked();

        // Set the flag in localStorage to indicate that handleDatabaseMarked has been executed
        localStorage.setItem('handleDatabaseMarkedExecuted', 'true');
    }

    // Load the question and restore the state of radio buttons
    loadQuestionByIndex(currentQuestionIndex);

    // Highlight functionality

    handleHighlight();





       // Function to handle radio button click and store the selected option
       $('input[name="radio-group"]').on('change', function () {
        var selectedOption = $('input[name="radio-group"]:checked').val();
        var radioId = $('input[name="radio-group"]:checked').attr('id');

        // Store the selected option and radio button ID in localStorage only if a radio button is checked
        if (selectedOption !== undefined) {
            localStorage.setItem('selectedOption_' + questionsData[currentQuestionIndex].qbank_question_id, selectedOption);
            localStorage.setItem('radioId_' + questionsData[currentQuestionIndex].qbank_question_id, radioId);
        }

        if (testMode === 'toggleTimed') {
            $('#card-border').hide();
            $('#hide-explanation').hide();
        } else {
            $('#card-border').show();
            $('#hide-explanation').show();
        }
    });


    // add marked question

    $("#question_mark").change(function () {
        handleCheckboxChange(this);
    });


     // add note to the question

     $('#note_model').click(function(){

        var note=localStorage.getItem('questionNote_'+ questionsData[currentQuestionIndex].qbank_question_id, 'questionNote');

        $('#noteModal').modal('show');

        $('#question_note').val(note);


     });


   $('#add_note_btn').click(function(){

    var questionNote=  $('#question_note').val();



    localStorage.setItem('questionNoteChecked_'+ questionsData[currentQuestionIndex].qbank_question_id, 'true');
    localStorage.setItem('questionNote_'+ questionsData[currentQuestionIndex].qbank_question_id, questionNote);

    loadQuestionByIndex(currentQuestionIndex);

    });

    $('#delete_note_btn').click(function(){

    localStorage.setItem('questionNoteChecked_'+ questionsData[currentQuestionIndex].qbank_question_id, 'false');
    localStorage.setItem('questionNote_'+ questionsData[currentQuestionIndex].qbank_question_id, '');
    loadQuestionByIndex(currentQuestionIndex);
    $('#noteModal').modal('hide');

    });



    // Check if the radio button state exists in local storage and restore it
    var storedOption = localStorage.getItem('selectedOption_' + questionsData[currentQuestionIndex].qbank_question_id);
    var storedRadioId = localStorage.getItem('radioId_' + questionsData[currentQuestionIndex].qbank_question_id);

    if (storedOption !== null && storedRadioId !== null) {
        $('#' + storedRadioId).prop('checked', true);
    }


    // end question block


    $(document).on('click', '#endblock', function () {
            Swal.fire({
                title: "End Test",
                text: "This is your final warning!",
                html: '<p>This is your final warning!</p> <p>Are you sure you want to end this exam?</p>',
                buttonsStyling: !1,
                showCloseButton: !0,
                showConfirmButton: !1,
                footer: '<button type="button" class="swal2-cancel btn btn-default" onclick="swalClose()">No</button><button type="button" class="swal2-cancel btn btn-primary" onclick="examEnd()">Yes</button>',
            });
        $(".swal2-popup").css({"width": "32em"});
        $(".swal2-title").css({"background": "#3852A4", "color": "#fff"});

    });


     // end question block suspend


     $(document).on('click', '#suspend', function () {
            Swal.fire({
                title: "Suspend Test",
                text: "This is your final warning!",
                html: '<p>You are about to suspend this exam.</p> <p>Do you want to suspend this exam?</p',
                buttonsStyling: !1,
                showCloseButton: !0,
                showConfirmButton: !1,
                footer: '<button type="button" class="swal2-cancel btn btn-default" onclick="swalClose()">No</button><button type="button" class="swal2-cancel btn btn-primary" onclick="examSuspend()">Yes</button>',
            });
        $(".swal2-popup").css({"width": "32em"});
        $(".swal2-title").css({"background": "#3852A4", "color": "#fff"});

    });










}); // ready function end


function swalClose() {
    Swal.close();
}


function examEnd(){
    var hash_id = $('#hash_id').val();
    var mark_qbs = $('#mark_qbs').val();
    $.ajax({
        type: "GET",
        url: "",
        data: {hash_id: hash_id, mark_qbs: mark_qbs},
        success: function (data) {
            location.replace('');
        }
    });
}


function examSuspend(){
    var hash_id = $('#hash_id').val();
    var mark_qbs = $('#mark_qbs').val();
    $.ajax({
        type: "GET",
        url: "",
        data: {hash_id: hash_id, mark_qbs: mark_qbs},
        success: function (data) {
            location.replace('');
        }
    });
}



// Handle page refresh by restoring the state of radio buttons and storing the current question index in sessionStorage
window.onbeforeunload = function () {

    // Store the state of radio buttons in local storage
    storeRadioButtonState();
    localStorage.setItem('currentQuestionIndex', currentQuestionIndex);


};

// Handle navigating to the last active question after page refresh
window.onload = function () {
    // Check if the current question index exists in sessionStorage and navigate to it
    var storedIndex = localStorage.getItem('currentQuestionIndex');
    if (storedIndex !== null) {
        //loadQuestionByIndex(parseInt(storedIndex));
    }
};


function handleDatabaseMarked(){

    var markedQuestionResult={!! $question_marked !!} ;

    var markedquestion=JSON.stringify(markedQuestionResult);

    var markedquestionsData=JSON.parse(markedquestion);


    if(markedquestionsData !== null && markedquestionsData.length !== 0){



        markedquestionsData.forEach(function (question, index) {


            var markedQuestion= localStorage.getItem('questionMarkChecked_' + markedquestionsData[index].qbank_question_id);

            if (markedQuestion == null || markedQuestion == ""){

                localStorage.setItem('questionMarkChecked_'+ markedquestionsData[index].qbank_question_id, 'true');

            }


        });

    }




}


function handleDatabaseNotes(){

    var noteQuestionResult={!! $question_notes !!} ;

    var notequestion=JSON.stringify(noteQuestionResult);

    var notequestionsData=JSON.parse(notequestion);

    if(notequestionsData !== null && notequestionsData.length !== 0){

        notequestionsData.forEach(function (question, index) {


           var noteQuestion= localStorage.getItem('questionNote_' + notequestionsData[index].qbank_question_id);

           if (noteQuestion == null || noteQuestion == ""){

            localStorage.setItem('questionNoteChecked_'+ notequestionsData[index].qbank_question_id, 'true');
            localStorage.setItem('questionNote_'+ notequestionsData[index].qbank_question_id, notequestionsData[index].note);


            }


        });

    }




}






</script>


<script src="https://johannburkard.de/resources/Johann/jquery.highlight-5.js"></script>


<script>

function handleHighlight() {
    $('.highlightable').on('mouseup', function() {
        var selection = window.getSelection();
        if (selection && selection.toString().trim() !== '') {
            var questionId = $('#question-id').text().trim();
            toggleHighlight(questionId, selection);
        }
    });
}

function toggleHighlight(questionId, selection) {
    var ranges = getRangesFromSelection(selection);

    ranges.forEach(function (range) {
        // Check if the selection is within the .highlightable container
        var highlightableContainer = getHighlightableContainer(range.commonAncestorContainer);
        if (!highlightableContainer) {
            return;
        }

        var isHighlighted = isRangeHighlighted(range);

        if (isHighlighted) {
            // Remove highlight
            var highlightId = getHighlightId(range);
            if (highlightId) {
                removeHighlight(highlightId);
            }
        } else {
            // Add highlight
            var spans = createHighlightsFromRange(range, questionId);
            spans.forEach(function (span) {
                highlightableContainer.appendChild(span);
            });
        }
    });

    if (typeof selection.removeAllRanges === 'function') {
    selection.removeAllRanges();
    }
}

function createHighlightsFromRange(range, questionId) {
    var spans = [];

    // Clone the range to avoid modifying the original range
    var clonedRange = range.cloneRange();

    // Iterate over the range's nodes and create spans
    while (clonedRange.toString() !== '') {
        var span = createHighlightSpan(clonedRange, questionId);
        spans.push(span);
    }

    // Restore the original selection
    range.removeAllRanges();
    range.addRange(clonedRange);

    return spans;
}

function createHighlightSpan(range, questionId) {
    var span = document.createElement('span');
    var highlightId = generateUniqueId();
    span.className = 'highlight';
    span.setAttribute('data-highlight-id', highlightId);

    // Surround only the current node with the span
    range.surroundContents(span);

    // Move to the next node
    range.setStartAfter(span);
    range.collapse(true);

    // Send AJAX request to create highlight
    createHighlight(questionId, span.textContent, highlightId);

    return span;
}




function getRangesFromSelection(selection) {
    var ranges = [];

    for (var i = 0; i < selection.rangeCount; i++) {
        ranges.push(selection.getRangeAt(i));
    }

    return ranges;
}

function getHighlightableContainer(node) {
    // Traverse up the DOM tree to find the closest .highlightable container
    while (node && node !== document.body) {
        if (node.classList && node.classList.contains('highlightable')) {
            return node;
        }
        node = node.parentNode;
    }
    return null;
}

function isRangeHighlighted(range) {
    var startContainer = range.startContainer.parentElement;
    var endContainer = range.endContainer.parentElement;

    return startContainer && startContainer.classList.contains('highlight') &&
           endContainer && endContainer.classList.contains('highlight');
}

function getHighlightId(range) {
    var startContainer = range.startContainer.parentElement;
    return startContainer ? startContainer.getAttribute('data-highlight-id') : null;
}

function generateUniqueId() {
    // Function to generate a unique ID, you can use a library or your own logic
    return  Date.now() + '' + Math.floor(Math.random() * 1000);
}

function createHighlight(questionId, selectedText, highlightId) {
    // Perform AJAX request to your server to create a highlight
    $.ajax({
        type: 'POST',
        url: '/create_question_highlights',
        data: {
            _token: '{{ csrf_token() }}',
            questionId: questionId,
            selectedText: selectedText,
            highlightId: highlightId,
        },
        success: function(response) {
            // Handle success response
            console.log('Highlight created successfully:', response);
        },
        error: function(error) {
            // Handle error
            console.error('Error creating highlight:', error);
        },
    });
}

function removeHighlight(highlightId) {
    // Find the highlight element using its data-highlight-id attribute
    var highlightElement = document.querySelector('[data-highlight-id="' + highlightId + '"]');

    if (highlightElement) {
        // Create a range that encompasses the entire highlight element
        var range = document.createRange();
        range.selectNodeContents(highlightElement);

        // Delete the highlight element
        highlightElement.parentNode.replaceChild(range.extractContents(), highlightElement);

        // Perform AJAX request to your server to delete a highlight
        $.ajax({
            type: 'DELETE',
            url: '/delete_question_highlights/' + highlightId,
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                // Handle success response
                console.log('Highlight deleted successfully:', response);
            },
            error: function(error) {
                // Handle error
                console.error('Error deleting highlight:', error);
            },
        });
    }
}


function highlightAllText(questionId) {
    // Perform AJAX request to get all highlights for the specified question
    $.ajax({
        type: 'POST',
        url: '/get_question_highlights',
        data: {
            _token: '{{ csrf_token() }}',
            questionId: questionId,
        },
        success: function(response) {
            // Apply the highlights on the page
            applyHighlights(response.highlights);
        },
        error: function(error) {
            // Handle error
            console.error('Error retrieving highlights:', error);
        },
    });
}




function applyHighlights(highlights) {
    $('.highlightable').each(function () {
        // Find all text nodes within the highlightable div and its descendants
        var textNodes = getAllTextNodes(this);

        highlights.forEach(function (highlight) {
            var highlightText = highlight.highlight_text;

            textNodes.forEach(function (textNode) {
                var textContent = textNode.nodeValue;

                // Continue with the highlighting process only if the highlight text is found in the text content
                if (textContent.includes(highlightText)) {
                    var escapedHighlightText = highlightText.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
                    var regex = new RegExp(escapedHighlightText, 'ig');

                    var match;
                    while ((match = regex.exec(textContent)) !== null) {
                        var pos = match.index;

                        // Check if the offset is within the valid range of the text node
                        if (pos >= textContent.length) {
                            console.warn("Invalid offset for highlight:", highlight);
                            continue; // Skip this highlight
                        }

                        var spannode = document.createElement('span');
                        spannode.className = 'highlight';
                        spannode.setAttribute('data-highlight-id', highlight.question_highlight_id);

                        // Adjust the offset if it's at the end of the text node
                        var adjustedPos = pos < textContent.length - 1 ? pos : textContent.length - 1;

                            var start = textNode.splitText(adjustedPos);

                        var end = start.splitText(match[0].length);
                        var clonedNode = start.cloneNode(true);
                        spannode.appendChild(clonedNode);
                        start.parentNode.replaceChild(spannode, start);

                        textContent = end.nodeValue;
                        regex.lastIndex = 0;
                    }
                }
            });
        });
    });
}



    function getAllTextNodes(element) {
        var textNodes = [];

        function traverse(node) {
            if (node.nodeType === Node.TEXT_NODE) {
                textNodes.push(node);
            } else {
                for (var i = 0; i < node.childNodes.length; i++) {
                    traverse(node.childNodes[i]);
                }
            }
        }

        traverse(element);
        return textNodes;
    }









$(document).keydown(function(event) {
    // Check if Ctrl key is pressed and the pressed key is 'C'
    if (event.ctrlKey && (event.key === 'c' || event.key === 'C')) {
        // Prevent the default behavior (e.g., copy)
        event.preventDefault();

    }
});








</script>







<style>
    .loader-container {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: rgba(0, 0, 0, 0.7); /* Adjust the alpha value for desired transparency */
      z-index: 9999;
    }
    .loader {
      border: 4px solid rgba(255, 255, 255, 0.1);
      border-top: 4px solid #007bff; /* Change this to your preferred color */
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 2s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>

<style>
    /* Add custom styles for the draggable and resizable modal */
    .draggable {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .resizable {
        resize: both;
        overflow: hidden;
    }

    .modal-footer {
        background-color: transparent;
        border: none;
    }

    .modal-footer button {
        background-color: transparent;
        border: none;
        margin: 0 10px;
    }

    .modal-footer button:focus {
        outline: none;
    }

    .modal-footer button:hover {
        background-color: rgba(0, 0, 0, 0.2);
    }

    .model-mobile-desktop{

         left: 304px;
         top: -5.5px;
         max-width: 95%;
         width: auto;
         heigh: auto;
    }

    @media (max-width: 768px) {
      /* Your mobile-specific styles go here */
       .model-mobile-desktop{

                 left: 0px;
                 top: -5.5px;
                 max-width: 95%;
                 width: auto;
                 heigh: auto;
            }
    }

    .modal_image{

font-size: 12pt !important;
font-family: Arial, sans-serif !important;


}


</style>

    <!-- Loader Container -->
    <div class="loader-container" id="loaderContainer" style="display:none;">
        <div class="loader">
        </div>
    </div>

    <body>


        <!-- Model for popup image in side question explination or question -->
        <div class="modal">
        <div class="modal-content">
            <img src="" alt="Zoomed In Image" id="zoomed-image">
        </div>
        </div>


        <!-- ============================================================== -->
            <!-- Main Page begin -->
        <!-- ============================================================== -->
        <div id="layout-wrapper">


            <!-- ========== Top Header Start ========== -->
            <header id="page-topbar">
                <div class="layout-width">
                    <div class="navbar-header">
                        <div class="d-flex">
                            <!-- LOGOs -->
                            <div class="navbar-brand-box horizontal-logo">
                                <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="https://aceamcq.com/wp-content/uploads/2023/07/WhatsApp_Image_2023-08-04_at_7.55.46_PM-removebg-preview.png" alt="" height="22">
                                </span>
                                    <span class="logo-lg">
                                    <img src="assets/images/logo-dark.png" alt="" height="17">
                                </span>
                                </a>

                                <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="https://aceamcq.com/wp-content/uploads/2023/07/WhatsApp_Image_2023-08-04_at_7.55.46_PM-removebg-preview.png" alt="" height="22">
                                </span>
                                    <span class="logo-lg">
                                    <img src="https://aceamcq.com/wp-content/uploads/2023/07/WhatsApp_Image_2023-08-04_at_7.55.46_PM-removebg-preview.png" alt="" height="17">
                                </span>
                                </a>
                            </div>

                            <!-- side bar toggle humburger icon-->

                            <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                                <span class="hamburger-icon">
                                    <span class="bg-white"></span>
                                    <span class="bg-white"></span>
                                    <span class="bg-white"></span>
                                </span>
                            </button>

                            <!-- Question ID and numbers div-->
                            <div class="app-search">
                                <div class="position-relative">
                                    <div> Q.<span id="current-question-no"></span> of <span id="total-question-no"></span> </div>
                                    <div >Q.ID: <span id="question-id"> </span> </div>
                                </div>
                            </div>





                        </div> <!-- d-flex Div close-->



                        <!-- marked btn start-->
                        <div class="app-search d-none d-md-block" >
                            <div id="mark">
                                <div class="d-flex" style="padding: 1px 12px 5px 12px;">
                                    <input id="question_mark" type="checkbox" class="flag_status">
                                    <span class="span_mark" style="margin-top: 3px;"><svg class="mark_svg"><svg id="whiteflag" viewBox="0 0 22 30"><g style="stroke: #FCFCFC; stroke-width: 2.2; fill: #B70808;"><g id="flag"><line x1="10" y1="35" x2="1.5" y2="4" class="icon"></line><path d="M20,8c-2,3-4,7-7,8c-2,1-5,2-7,3C5,14,4,9,1,5C8,1,13,10,20,8z" class="icon"></path></g></g></svg></svg></span>
                                    <!--<i class="bx bx-bookmark fs-22"></i>-->
                                    <span class="mt-2" style="margin-top: 11px !important;">Mark</span>
                                </div>
                            </div>
                        </div>

                        <!-- marked btn end-->






                        <!-- question Next and Previous btn start-->

                        <div class="d-flex align-items-center middle-menu">


                            <div class="ms-1" id="previous-question-btn"  onclick="loadPreviousQuestion()">
                                <a class="step2 medium-screen-icon ">
                                    <i class="previous-icon"></i>
                                    <div class="header-icon-text text-white" style="margin-left: -12px;">Previous</div>
                                </a>
                            </div>
                            <div class="ms-1" id="next-question-btn" onclick="loadNextQuestion()">
                                <a class="step3 medium-screen-icon ">
                                    <i class="next-icon"></i>
                                    <div class="header-icon-text text-white" style="margin-left: 2px;">Next</div>
                                </a>
                            </div>
                        </div>

                        <!-- question Next and Previous btn end-->


                        <div class="ms-4 mobile-hide" id="lab-values" style="height: 45px;" data-bs-toggle="modal" data-bs-target="#labModal">
                            <svg xmlns="http://www.w3.org/2000/svg" style="visibility: hidden; width: 0; height: 0;">
                                <style type="text/css">
                                    #labsIcon rect,
                                    #labsIcon path {
                                        stroke: #000;
                                        stroke-width: 10;
                                    }

                                    #noteIcon rect {
                                        stroke: #000;
                                        stroke-width: 2;
                                    }

                                    #calcIcon rect,
                                    #calcIcon path {
                                        fill: #FFF;
                                        stroke: #000;
                                        stroke-width: 0.5;
                                    }

                                    #lockIcon circle,
                                    #lockIcon rect {
                                        fill: none;
                                        stroke: #EE0;
                                    }

                                    #pencil rect,
                                    #pencil polyline {
                                        stroke: #000;
                                        stroke-width: 2;
                                    }

                                    #zoomout circle {
                                        stroke: #000;
                                        stroke-width: 2;
                                        fill: none;
                                    }
                                </style>
                                <defs>
                                    <linearGradient x1="8" y1="19" x2="31" y2="19" id="lg1">
                                        <stop offset="0" style="stop-color: #666;"></stop>
                                        <stop offset="1" style="stop-color: #CCC;"></stop>
                                    </linearGradient>
                                    <linearGradient id="yellowBeaker" x2="0" y2="1">
                                        <stop offset="15%" stop-color="rgba(255,255,255,0.7)"></stop>
                                        <stop offset="17%" stop-color="yellow"></stop>
                                    </linearGradient>
                                    <linearGradient id="pinkBeaker" x2="0" y2="1">
                                        <stop offset="30%" stop-color="rgba(255,255,255,0.7)"></stop>
                                        <stop offset="35%" stop-color="pink"></stop>
                                    </linearGradient>
                                    <linearGradient id="tealBeaker" x2="0" y2="1">
                                        <stop offset="40%" stop-color="rgba(255,255,255,0.85)"></stop>
                                        <stop offset="42%" stop-color="skyblue"></stop>
                                    </linearGradient>
                                    <g id="arrow">
                                        <polygon stroke-linejoin="round" points="6,12 20,12 20,6 35,15 20,26 20,20 6,20"></polygon>
                                    </g>
                                    <g id="flag">
                                        <line x1="10" y1="35" x2="1.5" y2="4" class="icon"></line>
                                        <path d="M20,8c-2,3-4,7-7,8c-2,1-5,2-7,3C5,14,4,9,1,5C8,1,13,10,20,8z" class="icon"></path>
                                    </g>
                                    <g id="pencil">
                                        <rect transform="rotate(-60,90,48)" width="90" height="30" style="fill: #F7971D;"></rect>
                                        <polyline points="3,102 5,127 30,117" style="fill: #FFF;"></polyline>
                                        <polyline points="4.5,117 5,127 14.5,123"></polyline>
                                        <rect transform="rotate(-60,45,-30)" width="25" height="30" style="fill: #F06567;"></rect>
                                    </g>
                                    <g id="Group_4935" data-name="Group 4935" transform="translate(322 -1279)">
                                        <path id="Rectangle_240" data-name="Rectangle 240" d="M30,0H130a0,0,0,0,1,0,0V158a0,0,0,0,1,0,0H30A30,30,0,0,1,0,128V30A30,30,0,0,1,30,0Z" transform="translate(-317 1295)" fill="#d7dced"></path>
                                        <g id="Rectangle_237" data-name="Rectangle 237" transform="translate(-322 1289)" fill="rgba(255,255,255,0)" stroke="#fff" stroke-width="7">
                                            <rect width="396" height="169" rx="35" stroke="none"></rect>
                                            <rect x="3.5" y="3.5" width="389" height="162" rx="31.5" fill="none"></rect>
                                        </g>
                                        <rect id="Rectangle_238" data-name="Rectangle 238" width="6" height="169" transform="translate(-190 1289)" fill="#fff"></rect>
                                        <rect id="Rectangle_239" data-name="Rectangle 239" width="6" height="169" transform="translate(-64 1289)" fill="#fff"></rect>
                                        <g id="Group_4934" data-name="Group 4934" transform="translate(0 -4)">
                                            <text id="A" transform="translate(-253 1400)" font-size="70" font-family="ArialNarrow-Bold, Arial Narrow" font-weight="700" letter-spacing="-0.002em">
                                                <tspan x="-20.713" y="0">A</tspan>
                                            </text>
                                            <text id="A-2" data-name="A" transform="translate(-124 1415)" fill="#fff" font-size="110" font-family="ArialNarrow-Bold, Arial Narrow" font-weight="700" letter-spacing="-0.002em">
                                                <tspan x="-32.549" y="0">A</tspan>
                                            </text>
                                            <text id="A-3" data-name="A" transform="translate(5 1433)" fill="#fff" font-size="160" font-family="ArialNarrow-Bold, Arial Narrow" font-weight="700" letter-spacing="-0.002em">
                                                <tspan x="-47.344" y="0">A</tspan>
                                            </text>
                                        </g>
                                    </g>
                                </defs>
                                <symbol id="invertIcon" viewBox="4 2 28 32">
                                    <path d="m 31,17.5 a 13,13 0 1 1 -26,0 13,13 0 1 1 26,0" style="fill: #F8F8F8; stroke: #333; stroke-width: 1;"></path>
                                    <path d="m 29,11 a 12,12 0 0 1 -22,13 z" style="fill: url(#lg1); stroke: #111; stroke-width: 1;"></path>
                                    <path d="m 28,11 a 11,11 0 0 1 -21.5,12.5 z" style="fill: #111;"></path>
                                </symbol>
                                <symbol id="labsIcon" viewBox="0 0 260 340">
                                    <rect x="59" y="30" width="140" height="200" rx="20" ry="20" fill="url(#yellowBeaker)"></rect>
                                    <rect x="175" y="14" width="55" height="290" rx="10" ry="10" fill="url(#pinkBeaker)"></rect>
                                    <path d="M50,90 l-35,130 t-1,30 0,30 t48,20 130,-20 v-60 l-35-130 z" fill="url(#tealBeaker)"></path>
                                </symbol>
                                <symbol id="refIcon" viewBox="0 0 48 48">
                                    <rect x="58" y="38" width="20" height="29" transform="matrix(1,0,-0.815,0.58,0,0)" style="fill: #333; stroke: #333; stroke-width: 0.5;"></rect>
                                    <rect x="29" y="56" rx="1" ry="1" width="29" height="8.1" transform="matrix(0.81,-0.58,0,1,0,0)" style="fill: #935BBF; stroke: #333; stroke-width: 1;"></rect>
                                    <rect x="2.1" y="40" width="21.3" height="7" style="fill: #C8C8C8;"></rect>
                                    <rect x="1.7" y="39" width="22" height="0.9" style="fill: #333;"></rect>
                                    <rect x="1.6" y="47" width="22" height="0.9" style="fill: #333;"></rect>
                                    <rect x="29" y="47" rx="1" ry="1" width="29" height="8.1" transform="matrix(0.81,-0.58,0,1,0,0)" style="fill: #8D91F0; stroke: #45736F; stroke-width: 1;"></rect>
                                    <rect x="0" y="31" width="22.5" height="7" style="fill: #C8C8C8;"></rect>
                                    <rect x="45" y="23" rx="1" ry="1" width="20" height="29" transform="matrix(1,0,-0.81,0.58,0,0)" style="fill: #8D91F0; stroke: #45736F; stroke-width: 1;"></rect>
                                    <rect x="0" y="30" width="24" height="1" style="fill: #45736F;"></rect>
                                    <rect x="0" y="38" width="24" height="1" style="fill: #45736F;"></rect>
                                    <rect x="26" y="36" rx="1" ry="1" width="29" height="8.1" transform="matrix(0.81,-0.58,0,1,0,0)" style="fill: #A67C52; stroke: #98414E; stroke-width: 1;"></rect>
                                    <rect x="1" y="20.7" width="20" height="8.1" style="fill: #C8C8C8;"></rect>
                                    <rect x="30" y="6.9" width="20" height="29" transform="matrix(1,0,-0.81,0.58,0,0)" style="fill: #A67C52; stroke: #98414E; stroke-width: 1;"></rect>
                                    <rect x="0.7" y="21" width="20.4" height="0.7" style="fill: #98414E;"></rect>
                                    <rect x="0.63" y="28.8" width="20.3" height="1" style="fill: #98414E;"></rect>
                                    <rect x="36" y="17" width="6.5" height="11" transform="matrix(1,0,-0.81,0.59,0,0)" style="fill: #C8C8C8; stroke: #444; stroke-width: 0.7;"></rect>
                                </symbol>
                                <symbol id="noteIcon" viewBox="0 0 160 160">
                                    <rect x="0" y="20" width="130" height="80" fill="#FCFCFC"></rect>
                                    <text x="20" y="70" style="font-family: 'Chalkboard SE', 'Segoe Print', cursive; font-size: 40px;">
                                        ABC
                                    </text>
                                    <use xlink:href="#pencil" transform="rotate(25) translate(100,-20)"></use>
                                </symbol>
                                <symbol id="calcIcon" viewBox="2 2 32 28">
                                    <rect width="28" height="24" x="3.5" y="3.5" rx="3.5" style="fill: #999;"></rect>
                                    <path d="M3.5,22.5 l 0,5 l 28,0 l 0,-5" style="fill: #999;"></path>
                                    <rect width="24" height="10" x="5.5" y="7.5"></rect>
                                    <text style="font-size: 8px; font-family: Tahoma;">
                                        <tspan x="9" y="15">0.25</tspan>
                                    </text>
                                    <rect width="4" height="3" x="5.5" y="21.5"></rect>
                                    <rect width="4" height="3" x="11.5" y="21.5"></rect>
                                    <rect width="4" height="3" x="18.5" y="21.5"></rect>
                                    <rect width="4" height="3" x="24.5" y="21.5"></rect>
                                </symbol>
                                <symbol id="lockIcon" viewBox="0 0 32 30">
                                    <circle cx="16" cy="15" r="12" style="stroke-width: 3;"></circle>
                                    <circle cx="16" cy="12" r="3" style="stroke-width: 2;"></circle>
                                    <rect x="11" y="13" width="10" height="9" rx="1" style="fill: #EE0;"></rect>
                                    <path d="M 15,21 l 0,-2 a 1.75,1.75 0 1 1 2,0 l 0,2 z" style="fill: #457;"></path>
                                </symbol>
                                <symbol id="goIcon" viewBox="0 0 40 30">
                                    <use xlink:href="#arrow" style="fill: green; stroke: green; stroke-width: 6;"></use>
                                    <use xlink:href="#arrow" style="fill: green; stroke: white; stroke-width: 2;"></use>
                                </symbol>
                                <symbol id="stopIcon" viewBox="0 0 32 32">
                                    <path d="M 3,11 3,21 11,29 21,29 29,21 29,11 21,3 11,3 z" style="fill: #A00; stroke: #A00;"></path>
                                    <path d="M 5,12 5,20 12,27 20,27 27,20 27,12 20,5 12,5 z" style="fill: #F00; stroke: #FFF; stroke-width: 2;"></path>
                                </symbol>
                                <symbol id="whiteflag" viewBox="0 0 22 30">
                                    <use xlink:href="#flag" style="stroke: #FCFCFC; stroke-width: 2.2; fill: #B70808;"></use>
                                </symbol>
                                <symbol id="darkflag" viewBox="0 0 22 30">
                                    <use xlink:href="#flag" style="stroke: #555; stroke-width: 2; fill: #D92A2A;"></use>
                                </symbol>
                                <symbol id="pencilIcon" viewBox="0 0 80 160">
                                    <use xlink:href="#pencil"></use>
                                </symbol>
                                <symbol id="warningIcon" viewBox="0 0 10 10">
                                    <polygon points="5,0 10,10 0,10" style="fill: yellow;"></polygon>
                                    <polygon points="5,1 9,9.4 1,9.4" style="stroke: orange; stroke-width: 0.2; fill: yellow;"></polygon>
                                    <text x="5" y="8.7" style="text-anchor: middle; font-size: 8px; font-family: 'Baskerville Old Face', 'Bookman Old Style', Georgia, serif; font-weight: bold;">
                                        !
                                    </text>
                                </symbol>
                                <symbol id="zoomout" viewBox="0 0 50 50">
                                    <circle r="16" cx="32" cy="20"></circle>
                                    <rect x="25" y="18" width="14" height="4" rx="2" ry="2"></rect>
                                    <rect x="10" y="50" width="20" height="8" rx="3" ry="3" transform="rotate(135 20 45)"></rect>
                                </symbol>
                                <symbol id="zoomin" viewBox="0 0 50 50">
                                    <use xlink:href="#zoomout"></use>
                                    <rect x="30" y="12" width="4" height="16" rx="2" ry="2"></rect>
                                </symbol>
                                <symbol id="textZoom" viewBox="0 0 160 160">
                                    <use xlink:href="#Group_4935"></use>
                                </symbol>
                            </svg>

                            <span class="_span mobile-hide">
                                 <svg class="_svg">
                                <svg id="labsIcon" viewBox="0 0 260 340">
                                    <rect x="59" y="30" width="140" height="200" rx="20" ry="20" fill="url(#yellowBeaker)"></rect>
                                    <rect x="175" y="14" width="55" height="290" rx="10" ry="10" fill="url(#pinkBeaker)"></rect>
                                    <path d="M50,90 l-35,130 t-1,30 0,30 t48,20 130,-20 v-60 l-35-130 z" fill="url(#tealBeaker)"></path>
                                </svg>
                            </svg>
                            </span>
                            <p>Lab Values</p>
                        </div>

                        <!-- note start-->
                        <div class="ms-4 mobile-hide" id="note_model" style="height: 45px;" >
                            <span class="_span">
                                 <svg class="_svgnote">
                                                     <svg id="noteIcon" viewBox="0 0 160 160">
                                                         <rect x="0" y="20" width="130" height="80" fill="#FCFCFC"></rect>
                                                         <text x="20" y="70" style="font-family: 'Chalkboard SE', 'Segoe Print', cursive; font-size: 40px;"> ABC </text>
                                                         <g transform="rotate(25) translate(100,-20)">
                                                             <g id="pencil">
                                                                 <rect transform="rotate(-60,90,48)" width="90" height="30" style="fill: #F7971D;"></rect>
                                                                 <polyline points="3,102 5,127 30,117" style="fill: #FFF;"></polyline>
                                                                 <polyline points="4.5,117 5,127 14.5,123"></polyline>
                                                                 <rect transform="rotate(-60,45,-30)" width="25" height="30" style="fill: #F06567;"></rect>
                                                             </g>
                                                         </g>
                                                     </svg>
                                                 </svg>
                            </span>
                             <p>Notes</p>
                         </div>

                         <!-- note  end-->


                        <div class="d-flex align-items-center rgt-menu">

                            <!-- full scren button-->

                            <div class="ms-4" id="full-screen-tour">
                                <center style="margin-top: 3px">
                                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                            data-toggle="fullscreen">
                                        <i class='ri-fullscreen-fill text-white' style="font-size: 26px"></i>
                                    </button>
                                </center>
                                <span>Full Screen</span>
                            </div>


                        </div>





                    </div>
                </div>
            </header>
            <!-- ========== Top Header End ========== -->

            <!-- ========== Left Sidebar start ========== -->
            <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                            id="vertical-hover">
                        <i class="ri-record-circle-line"></i>
                    </button>
                </div>

                <div id="scrollbar">
                    <div class="container-fluid">

                        <div id="two-column-menu">
                        </div>
                        <ul class="navbar-nav" id="navbar-nav">



                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>

                <div class="sidebar-background"></div>
            </div>
            <!-- ==========Left Sidebar End ========== -->

            <div class="vertical-overlay"></div>

            <!-- ============================================================== -->
            <!-- Main Dashboard Div and content start -->
            <!-- ============================================================== -->


            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">


                        <!--Tabs to show the content in body-->
                        <div class="row">
                            <div class="col">

                                <div class="h-100">

                                    <div id="tabs-1" class="tabs-1">
                                        <section class="cover">

                                                    <div class="row">
                                                        <div class="col-xl-12 col-md-12">

                                                            <div  class="highlightable">
                                                                <p style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;" class="heading-text"  id="question-text" >

                                                                </p>
                                                            </div>


                                                            <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div style="margin-bottom: 20px;" class="tablediv">
                                                                        <table class="table qtable">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="tbl_radio">
                                                                                        <input type="radio" id="test1" name="radio-group">
                                                                                        <label for="test1" style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;">A. <span id="option-1"></span></label>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td class="tbl_radio">
                                                                                        <input type="radio" id="test2" name="radio-group">
                                                                                        <label for="test2" style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;">B. <span id="option-2"></span></label>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td class="tbl_radio">
                                                                                        <input type="radio" id="test3" name="radio-group">
                                                                                        <label for="test3" style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;">C. <span id="option-3"></span></label>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td class="tbl_radio">
                                                                                        <input type="radio" id="test4" name="radio-group">
                                                                                        <label for="test4" style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;">D. <span id="option-4"></span></label>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td class="tbl_radio">
                                                                                        <input type="radio" id="test5" name="radio-group">
                                                                                        <label for="test5" style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;">E. <span id="option-5"></span></label>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>

                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <div class="card cd-info mt-3" id="card-border">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <div class="py-4">
                                                                        <span class="text-red  correct-option-mb" id ="correction-option-text" style="color: red ;font-size: 16px !important;">Incorrect</span><br>
                                                                        <span></span>
                                                                            <div class="d-flex align-items-center">

                                                                            <div class="flex-grow-1 ms-3">
                                                                                <p style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;" id="correct-option" class="correct-option-mb" >E</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->


                                                                    <div class="col-5 margin-correct-option">
                                                                        <div class="py-4 ">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="flex-shrink-0">
                                                                                <i class="bx bx-line-chart display-6 text-muted"></i>
                                                                                </div>
                                                                                <div class="flex-grow-1 ms-3">
                                                                                <span id="correct-ans-per">68%</span>
                                                                                <br>
                                                                                <span class="correct-option-mb" >Answered correctly</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->






                                                                    <div class="col-3">
                                                                        <div class="py-4">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="flex-shrink-0">
                                                                                    <i class="bx bx-calendar display-6 text-muted"></i>
                                                                                </div>
                                                                                <div class="flex-grow-1 ms-3">
                                                                                    <span class="correct-option-mb">2023</span>
                                                                                    <br>
                                                                                    <span class="correct-option-mb">Version</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                </div>
                                                            </div>

                                                        </div><!-- end col -->



                                                        <div style="margin-bottom: 20px;" class="col-xxl-6" id="hide-explanation">
                                                                <!-- Nav tabs -->
                                                            <ul class="nav nav-tabs mb-3" role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <a  style ="color:#fff !important; background-color: #3852A4;" class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true">
                                                                        Explanation
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                                <!-- Tab panes -->
                                                            <div class="tab-content ex-tab-content  text-muted">
                                                                <div style ="background-color: #F3F3F9 !important;" class="tab-pane active show" id="home" role="tabpanel">

                                                                    <div class="highlightable">

                                                                        <p style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;" class="mb-0" id="question-explanation" >

                                                                        </p>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div> <!-- end row-->
                                        </section>
                                    </div><!-- end tab -->
                                </div>
                            </div> <!-- end .h-100-->
                        </div> <!-- end col -->
                    </div>
                </div>
            <!-- container-fluid -->
            </div>

            <!-- ============================================================== -->
            <!-- Main Dashboard Div and content end -->
            <!-- ============================================================== -->


            <!-- ============================================================== -->
            <!-- Footer Start -->
            <!-- ============================================================== -->

            <!---Page Footer   --->
            <footer class="footer" style="position: fixed">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-6">
                            <h5 id="test_timing" class="text-white">


                            </h5>
                        </div>
                        <div class="col-sm-6 col-6">
                            <div class="text-sm-end  d-sm-block">
                                <div class="d-flex align-items-center rgt-footer-menu">


                                    <div class="ms-4 footer-mr" id="feedback" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                        <center>
                                            <i class="bx bx-message footer-icon"></i>
                                        </center>
                                        <p style="margin-top: -4px">Feedback</p>
                                    </div>
                                    <div class="ms-4 footer-mr" id="suspend">
                                        <center>
                                            <i class="bx bx-pause-circle footer-icon"></i>
                                        </center>
                                        <p style="margin-top: -4px">Suspend</p>
                                    </div>

                                    <div class="ms-4 footer-mr" id="endblock">
                                        <span class="_span">
                                             <svg class="_svgend" id="stopIcon" viewBox="0 0 32 32">
                                                    <path d="M 3,11 3,21 11,29 21,29 29,21 29,11 21,3 11,3 z" style="fill: #A00; stroke: #A00;"></path>
                                                    <path d="M 5,12 5,20 12,27 20,27 27,20 27,12 20,5 12,5 z" style="fill: #F00; stroke: #FFF; stroke-width: 2;"></path>
                                                </svg>
                                        </span>
                                        <p>End Block
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div> <!-- END layout-wrapper -->

    </body>



</html>










<script>


    // Function to open the modal window
    function openModal(event, url) {

        var baseUrl = '{{ url('/') }}';
        url = baseUrl + '/'+ url;
        event.preventDefault(); // Prevent the default link behavior

        // Set the URL of the image
        $('#iframeContent').attr('src', url);

        // Open the modal
        $('#myModal').modal('show');

        // Make the modal draggable
        $('.modal-dialog').draggable();

        // Make the modal resizable
        $('.modal-dialog').resizable({
        alsoResize: "#iframeContent",
        aspectRatio: true
        });

        // Reset image scale to 1 when modal opens
        $('#iframeContent').css('transform', 'scale(1)');
    }

    // Zoom In function
    function zoomIn() {
        const currentScale = parseFloat($('#iframeContent').css('transform').split(',')[3]);
        const newScale = currentScale + 0.1;
        $('#iframeContent').css('transform', `scale(${newScale})`);
    }

    // Zoom Out function
    function zoomOut() {
        const currentScale = parseFloat($('#iframeContent').css('transform').split(',')[3]);
        const newScale = currentScale - 0.1;
        if (newScale >= 0.1) {
        $('#iframeContent').css('transform', `scale(${newScale})`);
        }
    }


        // Function to close the modal
        function closeModal() {
        $('#myModal').modal('hide');
    }

    // Attach click event to the element with ID "close_model"
    $(document).on('click', '#close_model', function() {
        closeModal();
    });
        // Set up interact.js for touch-based dragging and resizing
    interact('.draggable').draggable({
        listeners: {
            move(event) {
                const target = event.target
                // Keep the dragged position in the data-x/data-y attributes
                const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
                const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy
                // Translate the element
                target.style.transform = `translate(${x}px, ${y}px)`
                // Update the position attributes
                target.setAttribute('data-x', x)
                target.setAttribute('data-y', y)
            }
        }
    }).resizable({
        edges: { top: true, left: true, bottom: true, right: true },
        listeners: {
            move(event) {
                const target = event.target
                const x = (parseFloat(target.getAttribute('data-x')) || 0)
                const y = (parseFloat(target.getAttribute('data-y')) || 0)
                // Update the element's dimensions
                target.style.width = event.rect.width + 'px'
                target.style.height = event.rect.height + 'px'
                // Translate when resizing from top or left edges
                target.style.transform = `translate(${x}px, ${y}px)`
            }
        }
    });








</script>
<!--##################################### Custom Code End for image popup in question ###################################################-->




<!--##################################### designing the font for question and explination start ###################################################-->


<script>



// Function to apply CSS styles to all elements within the specified elements
function applyFontStylesToElements(selector) {
  const elements = document.querySelectorAll(selector);

  if (elements) {
    const fontSize = '12pt'; // Change to your desired font size
    const fontFamily = 'Arial, sans-serif'; // Change to your desired font family

    elements.forEach(element => {
      // Select all elements within the specified element
      const childElements = Array.from(element.querySelectorAll('*'));

      childElements.forEach(childElement => {
        childElement.style.fontSize = fontSize;
        childElement.style.fontFamily = fontFamily;
      });
    });
  }
}

// Function to observe changes in the specified elements' content
function observeElementChanges(selector) {
  const elements = document.querySelectorAll(selector);

  if (elements) {
    elements.forEach(element => {
      const observer = new MutationObserver(function (mutationsList) {
        for (const mutation of mutationsList) {
          if (mutation.type === 'childList') {
            applyFontStylesToElements(selector);
          }
        }
      });

      observer.observe(element, { childList: true, subtree: true });
    });
  }
}

// Call the functions when the page loads
$(document).ready(function () {

  applyFontStylesToElements('#question-text');
  applyFontStylesToElements('#question-explanation');

  observeElementChanges('#question-text');
  observeElementChanges('#question-explanation');

});





</script>

<!--##################################### designing the font for question and explination end ###################################################-->














<!-- popup image Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-xl modal-dialog-centered draggable resizable  model-mobile-desktop" >
        <div class="modal-content">
        <div class="modal-header" style="background-color: #3852A4; color: #fff;">
            <p style="color:white;" class="modal-title"> Exhibit Display </p>
            <button type="button" id="close_model" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <img id="iframeContent" style="border: none; width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="zoomIn()"><i style ="color:#3852A4; font-size:20px;" class="fas fa-search-plus"></i></button>
            <button class="btn btn-secondary" onclick="zoomOut()"><i style ="color:#3852A4; font-size:20px;" class="fas fa-search-minus"></i></button>
        </div>
        </div>
    </div>
</div>




 <!--Modal Lab values-->

<div id="labModal" class="modal right fade" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;margin-top: 52px;">
    <div class="modal-dialog modal-dialog-scrollable" style="height: 84%;">
        <div class="modal-content">
            <div class="modal-header modal-header-lab-values-title" style="background: #D9D9D9">
                <h5 class="modal-title" id="myModalLabel">Lab Values</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                <i data-bs-dismiss="modal" title="Undock Lab Values" class="las la-external-link-square-alt fs-21"></i>
            </div>
            <div class="modal-header modal-header-lab-values bg-white">
                <input type="text" class="lab-search" id="lab-search" name="search">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="formCheck1">
                    <label class="form-check-label text-muted text-dark fw-bold" for="formCheck1">
                        SI Reference Intervals
                    </label>
                </div>
            </div>
            <div class="modal-header modal-header-lab-values bg-white">

                <ul class="nav nav-tabs lab-nav-tab" role="tablist">
                    <li class="nav-item lab-nav-item">
                        <a class="nav-link lab-nav-link active" data-bs-toggle="tab" href="#serum" role="tab" aria-selected="false">
                            Serum
                        </a>
                    </li>
                    <li class="nav-item lab-nav-item">
                        <a class="nav-link lab-nav-link" data-bs-toggle="tab" href="#cerebrospinal" role="tab" aria-selected="false">
                            Cerebrospinal
                        </a>
                    </li>
                    <li class="nav-item lab-nav-item">
                        <a class="nav-link lab-nav-link" data-bs-toggle="tab" href="#blood" role="tab" aria-selected="false">
                            Blood
                        </a>
                    </li>
                    <li class="nav-item lab-nav-item">
                        <a class="nav-link lab-nav-link" data-bs-toggle="tab" href="#bmi" role="tab" aria-selected="true">
                            Urine and BMI
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body lab-modal-body">

                <!-- Tab panes -->
                <div class="tab-content  text-muted">
                    <div class="tab-pane active" id="serum" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table label-table align-middle table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Serum</th>
                                    <th scope="col">Reference Range</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Aspartate aminotransferase (AST)</td>
                                    <td>12-38 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="cerebrospinal" role="tabpanel">

                        <div class="table-responsive">
                            <table class="table label-table align-middle table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Serum</th>
                                    <th scope="col">Reference Range</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Aspartate aminotransferase (AST)</td>
                                    <td>12-38 U/L</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="blood" role="tabpanel">

                        <div class="table-responsive">
                            <table class="table label-table align-middle table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Serum</th>
                                    <th scope="col">Reference Range</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Aspartate aminotransferase (AST)</td>
                                    <td>12-38 U/L</td>
                                </tr>
                                <tr>
                                    <td>Aspartate aminotransferase (AST)</td>
                                    <td>12-38 U/L</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="bmi" role="tabpanel">

                        <div class="table-responsive">
                            <table class="table label-table align-middle table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Serum</th>
                                    <th scope="col">Reference Range</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Aspartate aminotransferase (AST)</td>
                                    <td>12-38 U/L</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>




<!-- Modal Note -->
<div id="noteModal" class="modal modal-tutorial fade zoomIn" data-bs-backdrop="static" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #EEEEEE;padding: 3px;">
            <div class="modal-header modal-header-tutorial" style="background: #3852A4;padding: 0 13px;">
               <h5 class="modal-title text-white" id="noteModalLabel" style="margin: auto;">Edit Item Notes</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close" style="margin: unset !important;"></button>
            </div>
            <div class="modal-body" style="padding: 10px 10px 0 10px;">
                <div class="card">
                    <div class="card-body" style="padding: unset;border: 2px solid black;">
                        <textarea name="question_note" id="question_note" cols="30" rows="14" class="form-control">

                        </textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-bottom: 4px;justify-content: space-between;">
                <button type="button" id="add_note_btn"  class="btn btn-light" data-bs-dismiss="modal" style="border: 1px solid blue;">Save and Close</button>
                <button type="button" id="delete_note_btn" class="btn btn-light" style="border: 1px solid blue;">Delete Notes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Feedback -->
<div id="feedbackModal" class="modal modal-feedback fade zoomIn" data-bs-backdrop="static" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #EEEEEE;padding: 3px;">

            <div class="modal-header modal-header-tutorial ui-draggable-handle" style="background: #3852A4;padding: 7px 13px;">
                <i class="bx bx-message footer-icon text-white" style="margin-right: 6px;"></i> <h5 class="modal-title text-white" id="feedbackModalLabel">Feedback</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 10px 10px 0 10px;">
                <div class="card">
                    <div class="card-body" style="padding: unset;border: 2px solid black;">
                        <textarea name="" id="" cols="30" rows="14" class="form-control">

                        </textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-bottom: 4px;justify-content: space-between;">
                <div class="d-flex"><input type="checkbox" name="ch1" id="ch1"><p style="margin-top: 16px;margin-left: 4px;">Check here if your concern is for a software/technical issue.</p></div>
                <button type="button" class="btn btn-light" style="border: 1px solid blue;">Submit</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




@endsection

