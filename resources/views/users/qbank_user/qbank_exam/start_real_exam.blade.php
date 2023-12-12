<!DOCTYPE >
<html lang='en' >
   <head>
      <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>
         {{ $test->test_name }} Trial Examination
      </title>

        <!-- SweetAlert CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <link href='{{ asset("user/mock_user_assets/exam_assets/assets/css/screen.css")}}'  rel='stylesheet' type='text/css' />
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" crossorigin="anonymous">


        <!-- Bootstrap Bundle (includes Popper.js) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <!-- jQuery UI -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

        <!-- Include Interact.js (for touch-based interaction) -->
        <script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.12/dist/interact.min.js"></script>

    <style>

         /* Style the radio button */
         input[type=radio] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 5px; /* Adjust the size as needed */
            height: 5px; /* Adjust the size as needed */
            border: 2px solid #3852A4; /* Set the border color */
            border-radius: 50%; /* Make it round */
            outline: none;
            margin-right: 5px; /* Adjust the spacing as needed */
        }

        /* Style the checked state of the radio button */
        input[type=radio]:checked {
            background-color: #3852A4; /* Set the background color when checked */
            border-color: #3852A4; /* Set the border color when checked */
        }

        .next {
            background-color: #FFFFFF; /* White */
            color: #3852A4;
        padding: 10px 20px; /* Add some padding for a better appearance */
        border: none; /* Remove the default border */
        border-radius: 5px; /* Add some border radius for rounded corners */
        cursor: pointer; /* Add a pointer cursor on hover */
        font-size: 16px; /* Set the font size */
    }

    /* Add some styling for the buttons on hover */
    .next:hover {
        background-color: #5075c6;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        color: white
    }
      </style>

<script>
    // Data fetched from the server
    var questions = {!! json_encode($questions) !!};

    // Global variables
    var currentQuestionIndex = 0;
    var countdown;
    var questionData = []; // Array to store data for each question

    var questionTimings = []; // question timing


    // Function to start the countdown timer
    function startTimer() {
        // Retrieve remaining time from localStorage or set to default (12600 seconds)
        countdown = localStorage.getItem('timer') || 12600;

        // Update timer every second
        var interval = setInterval(function () {
            var hours = Math.floor(countdown / 3600);
            var minutes = Math.floor((countdown % 3600) / 60);
            var seconds = countdown % 60;

            // Display the remaining time
            $('#time').text(pad(hours) + ':' + pad(minutes) + ':' + pad(seconds));

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

    // Function to handle actions when the timer ends
    function timerEnded() {

        //handle the end mocks
        handleMocksEnd();
    }


    // Load the stored question data from localStorage
    function loadStoredQuestionData() {
        var storedData = localStorage.getItem('questionData');
        if (storedData) {
            questionData = JSON.parse(storedData);
        }
    }

    // Save the question data to localStorage
    function saveQuestionDataToLocalStorage() {
        localStorage.setItem('questionData', JSON.stringify(questionData));
    }

    // Function to save question data, including time spent on each question
    function saveQuestionData(selectedOption, isCorrect) {

        var currentQuestion = questions[currentQuestionIndex];

        // Retrieve timer value from localStorage (assuming it's in seconds)
        var endTimeInSeconds = Math.floor(new Date().getTime() / 1000);

        var startTime = questionTimings[currentQuestionIndex].startTime;

        // Calculate time spent in seconds
        var timeSpentInSeconds = endTimeInSeconds - startTime;




        // Create an object with question data and push it to the array
        var data = {
            question_id: currentQuestion.question_id,
            question_type: currentQuestion.question_type,
            selected_option: selectedOption,
            is_correct: isCorrect,
            time_spent: formatTime(timeSpentInSeconds)
        };



        questionData.push(data);



        // Save the updated question data to localStorage
        saveQuestionDataToLocalStorage();
    }


      // Function to format time to "mm:ss" (minutes:seconds)
        function formatTime(totalSeconds) {
            var minutes = Math.floor(totalSeconds / 60);
            var seconds = totalSeconds % 60;

            // Pad with leading zeros
            var formattedMinutes = pad(minutes);
            var formattedSeconds = pad(seconds);

            return formattedMinutes + ':' + formattedSeconds;
        }








    // Function to display the current question
    function showCurrentQuestion() {

    // Set question timing in seconds
    var startTimeSeconds = Math.floor(new Date().getTime() / 1000);
    questionTimings[currentQuestionIndex] = { startTime: startTimeSeconds };






        var currentQuestion = questions[currentQuestionIndex];

        // Update question count and content
        $('#question_count').text('Question ' + (currentQuestionIndex + 1) + ' of ' + questions.length);
        $('#question_text').html( currentQuestion.question_text);
        $('#option1').html(currentQuestion.option1);
        $('#option2').html(currentQuestion.option2);
        $('#option3').html(currentQuestion.option3);
        $('#option4').html(currentQuestion.option4);
        $('#option5').html(currentQuestion.option5);
    }


     // Function to retrieve the selected option value
     function getSelectedOptionValue() {
        var selectedOption = document.querySelector('input[name="options"]:checked');
        return selectedOption ? selectedOption.value : null;
    }

    // Function to move to the next question
    function nextQuestion() {
        // Retrieve the selected option
        var selectedOption = getSelectedOptionValue();

        // Check if a radio button is selected
        if (selectedOption === null) {
            // If no radio button is selected, show a confirmation dialog
            Swal.fire({
                title: "Warning",
                text: "Do you want to omit this question?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
            }).then((result) => {
                // If the user confirms, move to the next question
                if (result.isConfirmed) {
                    moveToNextQuestion();
                }
                // If the user cancels, do nothing
            });
        } else {
            // If a radio button is selected, move to the next question
            moveToNextQuestion();
        }
    }



    // Function to move to the next question
    function moveToNextQuestion() {
        // Retrieve the selected option and check if it's correct
        var selectedOption = getSelectedOptionValue();
        var currentQuestion = questions[currentQuestionIndex];
        var isCorrect = selectedOption == currentQuestion.correct_option;

        // Save question data before moving to the next question
        saveQuestionData(selectedOption, isCorrect);

        // Uncheck all radio buttons in the group
        $('input[name="options"]').prop('checked', false);

        // Move to the next question
        currentQuestionIndex++;
        if (currentQuestionIndex < questions.length) {
            showCurrentQuestion();
            saveCurrentIndex();
        } else {


            handleMocksEnd();






        }
    }


    function handleMocksEnd(){

         // Make an Ajax call to send the data to the server
         $.ajax({
                     type: 'POST',
                     url: '/generate_user_mock_history',
                     contentType: 'application/json',
                     data: JSON.stringify(questionData),
                     headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },

                    success: function (response) {

                          // Clear stored data
                        localStorage.removeItem('timer');
                        localStorage.removeItem('currentQuestionIndex');
                        localStorage.removeItem('questionData');
                        localStorage.removeItem('startTimeForNextQuestion');

                        // Clear the interval (assuming countdown is the variable holding the interval)
                        clearInterval(countdown);

                        // Reset the timer value (adjust the value as needed)
                        countdown = 12600; // Assuming 12600 is the default timer value

                        var userMocksId = response.user_mocks_id;

                         // Assuming your route name is 'your.route.name'
                        var url = '/mocks_user_mocks_result/' + userMocksId;

                        // Redirect the user to the generated URL
                        window.location.href = url;


                    },
                    error: function (error) {
                        console.error('Error saving question data:', error);

                          // Clear stored data
                            localStorage.removeItem('timer');
                            localStorage.removeItem('currentQuestionIndex');
                            localStorage.removeItem('questionData');
                            localStorage.removeItem('startTimeForNextQuestion');

                            // Clear the interval (assuming countdown is the variable holding the interval)
                            clearInterval(countdown);

                            // Reset the timer value (adjust the value as needed)
                            countdown = 12600; // Assuming 12600 is the default timer value
                    }


                });
    }

    function end_exam(){


        Swal.fire({
                title: "Warning",
                text: "Do you want to end the mocks?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
            }).then((result) => {
                // If the user confirms, move to the next question
                if (result.isConfirmed) {
                    handleMocksEnd();
                }
                // If the user cancels, do nothing
            });

    }



    // Function to load the stored question index from localStorage
    function loadStoredIndex() {
        var storedIndex = localStorage.getItem('currentQuestionIndex');
        if (storedIndex !== null) {
            currentQuestionIndex = parseInt(storedIndex);
        }
    }

    // Function to save the current question index to localStorage
    function saveCurrentIndex() {
        localStorage.setItem('currentQuestionIndex', currentQuestionIndex);
    }

    // Disable right-click and text selection on the document
    $(document).on('contextmenu', function () {
        return false;
    }).on('selectstart', function () {
        return false;
    });

    // Disable certain keyboard shortcuts (Ctrl+C, Ctrl+X, Ctrl+U)
    $(document).keydown(function (event) {
        if (examStarted) {
            if (event.ctrlKey && (event.keyCode === 67 || event.keyCode === 88)) {
                return false;
            }
            if (event.ctrlKey && event.keyCode === 85) {
                return false;
            }
        }
    });

    // Document ready function
    $(document).ready(function () {


        // Load the stored question data
        loadStoredQuestionData();


        // Start the timer, load the stored index, and show the current question
        startTimer();
        examStarted = true;
        loadStoredIndex();
        showCurrentQuestion();

        // Attach click event to the "Next" button
        $('#next_question_btn').on('click', function () {
            nextQuestion();
        });
    });

   // Function to reset data when the test ends
    function resetDataOnTestEnd() {
        // Clear stored data
        localStorage.removeItem('timer');
        localStorage.removeItem('currentQuestionIndex');
        localStorage.removeItem('questionData');
        localStorage.removeItem('startTimeForNextQuestion');

        // Clear the interval (assuming countdown is the variable holding the interval)
        clearInterval(countdown);

        // Reset the timer value (adjust the value as needed)
        countdown = 11700; // Assuming 11700 is the default timer value

        // Save the remaining time to localStorage before the page is unloaded
        localStorage.setItem('timer', countdown);

        // Clear the questionData array
        questionData = [];

        // Reset question timings
        questionTimings = [];
    }





    // Save the remaining time to localStorage before the page is unloaded
    $(window).on('beforeunload', function () {
        localStorage.setItem('timer', countdown);
    });


</script>




    </head>
   <body>
      <div id='root'>
         <div id='titlebar'>
            <div class='container2'>
               <div id='header'>
                  <h1>
                     <a href='#'><span>{{ $test->test_name }}</span> <span> Trial Examination</span></a>
                  </h1>
                  <div id='timer'>
                     <h6>
                        Time remaining:
                        <span id='time'>
                            <!-- Initial timer display will be updated by the script -->
                            03:30:00
                        </span>
                     </h6>
                  </div>
               </div>
            </div>
         </div>
         <div id='flag'>
         </div>
         <div class='container2' id='main'>
            <div id='root'>
                <div class='container2' id='main'>
                    <div class='left'>
                        <h5 id="question_count">
                            Question 1 of 150
                        </h5>
                        <div class='question'>
                            <form class="edit_answer" id="edit_answer_2585551" method="post">
                                <fieldset>
                                    <div id="question_text"></div>
                                    <ol>
                                        <li>
                                            <label for='answer_a'>
                                                <input id='answer_a' name='options' type='radio' value='1' />
                                                <span>A. <span id="option1"></span></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_b'>
                                                <input id='answer_b' name='options' type='radio' value='2' />
                                                <span>B. <span id="option2"></span> </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_c'>
                                                <input id='answer_c' name='options' type='radio' value='3' />
                                                <span >C. <span id="option3"></span></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_d'>
                                                <input id='answer_d' name='options' type='radio' value='4' />
                                                <span>D. <span id="option4"></span></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_e'>
                                                <input id='answer_e' name='options' type='radio' value='5' />
                                                <span>E. <span id="option5"></span></span>
                                            </label>
                                        </li>
                                    </ol>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id='footer'>
                <div id="end-links">
                    <ul>
                    <li>
                    <a accesskey="E" class="end" href="javascript:void(0)" onclick="end_exam()">End Examination</a>
                    </li>
                    </ul>

                </div>
                <div id='site-actions'>
                    <ul>
                        <li style="padding: 15px;">
                            <button id="next_question_btn" accesskey='N' class='next' >Next</button>
                        </li>
                    </ul>
                </div>
            </div>

   </body>


   <script>
     // Function to apply CSS styles to all elements within the specified elements
     function applyFontStylesToElements(selector) {
       const elements = $(selector);

       if (elements.length) {
         const fontSize = '100%'; // Change to your desired font size
         const fontFamily = 'inherit'; // Change to your desired font family

         elements.each(function () {
           // Remove existing font styles
           $(this).css({
             'font-size': '',
             'font-family': ''
           });

           // Select all elements within the specified element
           const childElements = $(this).find('*');

           childElements.each(function () {
             $(this).css({
               'font-size': fontSize,
               'font-family': fontFamily
             });
           });
         });
       }
     }

     // Function to observe changes in the specified elements' content
     function observeElementChanges(selector) {
       const elements = $(selector);

       if (elements.length) {
         elements.each(function () {
           const observer = new MutationObserver(function (mutationsList) {
             for (const mutation of mutationsList) {
               if (mutation.type === 'childList') {
                 applyFontStylesToElements(selector);
               }
             }
           });

           observer.observe(this, { childList: true, subtree: true });
         });
       }
     }

     // Call the functions when the page loads
     $(document).ready(function () {
       applyFontStylesToElements('#question_text');
       applyFontStylesToElements('#option1');
       applyFontStylesToElements('#option2');
       applyFontStylesToElements('#option3');
       applyFontStylesToElements('#option4');
       applyFontStylesToElements('#option5');
       observeElementChanges('#question-text');
       observeElementChanges('#option1');
       observeElementChanges('#option2');
       observeElementChanges('#option3');
       observeElementChanges('#option4');
       observeElementChanges('#option5');
     });
   </script>







    <!--##################################### Custom Code start for image popup in question ###################################################-->


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


        </style>


    <!--##################################### Custom Code start for image popup in question ###################################################-->


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
                        height: auto;
                }
        }


        </style>



        <!-- Modal -->
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

















</html>
