<!DOCTYPE >
<html lang='en' >
   <head>
      <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>
        {{ $mocksName }} Question Preview
      </title>


      <link href='{{ asset("user/mock_user_assets/exam_assets/assets/css/screen.css")}}'  rel='stylesheet' type='text/css' />









    </head>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


   <body>



      <div id='root'>
         <div id='titlebar'>
            <div class='container'>
               <div id='header'>
                  <h1>
                     <a href='#'><span>{{ $mocksName }}</span>: Questions Preview</a>
                  </h1>

               </div>
            </div>
         </div>
         <div id='flag'>
         </div>
         <div class='container' id='main'>
            <div id='root'>
                <div class='container' id='main'>
                    <div class='left'>
                        <h3 id="question_count">
                            Question 1 of {{ count($questions) }}
                        </h3>
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



</html>
