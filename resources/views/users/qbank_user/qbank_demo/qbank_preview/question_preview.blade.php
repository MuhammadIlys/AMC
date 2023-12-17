<!DOCTYPE >
<html lang='en' >
   <head>
      <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>
        {{ $mocksName }} Question Preview
      </title>


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




    </head>




   <body>



      <div id='root'>
         <div id='titlebar'>
            <div class='container2'>
               <div id='header'>
                  <h1>
                     <a href='#'><span>{{ $mocksName }}</span> <span>: Questions Preview</span></a>
                  </h1>

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
                            Question 1 of {{ count($questions) }}
                        </h5>
                        <div class='question'>
                            <form class="edit_answer" id="edit_answer_2585551" method="post">
                                <fieldset>
                                    <p id="question_text">

                                    </p>
                                    <ol>
                                        <li>
                                            <label for='answer_a'>
                                                <input id='answer_1' name='options' type='radio' value='1' />
                                                <span>A. <span id="option1"> </span></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_b'>
                                                <input id='answer_2' name='options' type='radio' value='2' />
                                                <span>B. <span id="option2"></span> </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_c'>
                                                <input id='answer_3' name='options' type='radio' value='3' />
                                                <span>C. <span id="option3"></span></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_d'>
                                                <input id='answer_4' name='options' type='radio' value='4' />
                                                <span>D. <span id="option4"></span></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_e'>
                                                <input id='answer_5' name='options' type='radio' value='5' />
                                                <span>E. <span id="option5"></span></span>
                                            </label>
                                        </li>
                                    </ol>
                                </fieldset>
                            </form>
                            <br> <br>
                            <label for="question_explanation"><strong>Question Explanation:</strong></label>
                            <hr>
                            <div id="question_explanation">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id='footer'>

                <div id='site-actions'>
                    <ul style="margin:auto">
                        <li style="padding: 15px;">
                            <button id="previous_question_btn"  class='next' >Previous</button>
                            <button id="next_question_btn"  class='next' >Next</button>

                        </li>
                    </ul>
                </div>
            </div>

   </body>

   <style>

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

        /* Add these styles to style the indicators */
        .indicator {
            display: inline-block;
            margin-left: 5px; /* Adjust the spacing as needed */
            font-size: 18px; /* Adjust the font size as needed */
        }

        .correct {
            color: green;
        }

        .incorrect {
            color: red;
        }

        .omitted {
            color: #999; /* Adjust the color for omitted indicator */
        }

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



   </style>



       <!-- Store PHP variables in JavaScript variables -->
       <script>
            var questions = @json($questions);
            var totalQuestions = {{ count($questions) }};
       </script>

    <script>
        $(document).ready(function () {

            var currentQuestion = 0;





            @if($question_id !== null)
            var question_id = parseInt({{ $question_id }});
                navigateToQuestionById(question_id);
            @endif



            // Initial load of the first question
            showQuestion(currentQuestion);

            $("#next_question_btn").on("click", function () {
                if (currentQuestion < totalQuestions - 1) {
                    currentQuestion++;
                    showQuestion(currentQuestion);
                }
            });

            $("#previous_question_btn").on("click", function () {
                if (currentQuestion > 0) {
                    currentQuestion--;
                    showQuestion(currentQuestion);
                }
            });

            function showQuestion(index) {
                // Update question count
                $("#question_count").text("Question " + (index + 1) + " of " + totalQuestions);

                // Fetch the question and related data for the current index
                var question = questions[currentQuestion];
                var pivot = question.pivot;

                // Update the HTML elements with the question and pivot data
                $("#question_text").html( question.question_text);
                $("#option1").html( question.option1);
                $("#option2").html( question.option2);
                $("#option3").html( question.option3);
                $("#option4").html(question.option4);
                $("#option5").html( question.option5);



                // Update other elements as needed
                $("#question_explanation").html(question.question_explanation);

                questionStatusChecker(pivot.choose_option,question.correct_option);
            }






            function questionStatusChecker(userChosenOption, questionCorrectOption) {
                // Disable radio buttons to prevent further changes
                $('input[type=radio]').attr('disabled', true);
                $('.indicator').remove();

                // Determine the status of the question
                var status;
                if (userChosenOption == 6) {
                    status = 'omitted';
                } else if (userChosenOption == questionCorrectOption) {
                    status = 'correct';
                } else {
                    status = 'incorrect';
                }

                // Check the radio button based on the user's choice
                $('input[name=options][value=' + userChosenOption + ']').prop('checked', true);

                // Add visual indicator
                addVisualIndicator(status, userChosenOption);

                // For omitted and incorrect answers, also add the indicator for the correct answer
                if (status === 'omitted' || status === 'incorrect') {
                    addVisualIndicator('correct', questionCorrectOption);
                }

                return status;
            }

            function addVisualIndicator(type, option) {
                // Add visual indicator
                var indicator = type === 'correct' ? '<span class="indicator correct">&#10004;</span>' : (type === 'omitted' ? '<span class="indicator omitted">&#10070;</span>' : '<span class="indicator incorrect">&#10008;</span>');
                var optionId = '#answer_' + option;
                $(optionId).parent().append(indicator); // Use append to add the indicator after the radio button
            }


               // Function to navigate to a specific question by question_id
            function navigateToQuestionById(questionId) {

                // Find the question index based on question_id
                var index = questions.findIndex(function (question) {
                    return question.question_id === questionId;
                });

                if (index !== -1) {
                    currentQuestion = index;
                    showQuestion(currentQuestion);
                } else {
                    console.error('Question with question_id ' + questionId + ' not found.');
                }
            }




        });
    </script>



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
    applyFontStylesToElements('#question_explanation');
    observeElementChanges('#question-text');
    observeElementChanges('#option1');
    observeElementChanges('#option2');
    observeElementChanges('#option3');
    observeElementChanges('#option4');
    observeElementChanges('#option5');
    observeElementChanges('#question_explanation');
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









    <!-- Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-xl modal-dialog-centered draggable resizable  model-mobile-desktop" >
            <div class="modal-content">
            <div class="modal-header" style="background-color: #3852A4; color: #fff;">
                <p style="color:white;" class="modal-title"> Exhibit Display </p>
                <button type="button" id="close_model" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <img id="iframeContent" style="border: none; width:  100%; height: 100%; object-fit: cover;">
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
