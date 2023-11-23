<!DOCTYPE >
<html lang='en' >
   <head>
      <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>
         Question 1 of 676
         &rsaquo; AMC MCQ Online Trial Examination
      </title>
       <!-- Add script for countdown timer -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
     <!-- SweetAlert CDN -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

      <link href='{{ asset("user/mock_user_assets/exam_assets/assets/css/screen.css")}}'  rel='stylesheet' type='text/css' />


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
        // Retrieve remaining time from localStorage or set to default (11700 seconds)
        countdown = localStorage.getItem('timer') || 11700;

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
        $('question_text').html( currentQuestion.question_text);
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
                        countdown = 11700; // Assuming 11700 is the default timer value

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
                            countdown = 11700; // Assuming 11700 is the default timer value
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
            <div class='container'>
               <div id='header'>
                  <h1>
                     <a href='#'>AMC MCQ Online Trial Examination</a>
                  </h1>
                  <div id='timer'>
                     <h6>
                        Time remaining:
                        <span id='time'>
                            <!-- Initial timer display will be updated by the script -->
                            03:15:40
                        </span>
                     </h6>
                  </div>
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
                            Question 1 of 150
                        </h3>
                        <div class='question'>
                            <form class="edit_answer" id="edit_answer_2585551" method="post">
                                <fieldset>
                                    <p id="question_text"></p>
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
                                                <span>C. <span id="option3"></span></span>
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
</html>
