
  
  
  
   // Function to show a success alert using SweetAlert
   function showSuccessAlert(message) {
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: message,
    });
  }

  // Function to show an error alert using SweetAlert
  function showErrorAlert(message) {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: message,
    });
  }

 function changeActiveColor(e){

   // Remove active class from all menu items
   var menuItems = document.getElementsByClassName("text-sm");
   for (var i = 0; i < menuItems.length; i++) {
     menuItems[i].classList.remove("active");
   }

   // Add active class to the clicked menu item
   event.target.classList.add("active");


  }


var questionsData = []; // Store the questions data globally
var currentQuestionIndex = 0; // Store the current question index

// when click on month in user dashboard
function onMonthClick2() {

   

  currentQuestionIndex = 0;
  $('#current-question-no').text(currentQuestionIndex + 1); // Reset current question number to 1

   // Show the loader when the AJAX request starts
   $("#loaderContainer").show();

  $.ajax({
    url: "./month_question_loader.php", // Replace with the URL of your PHP script
    dataType: "json",
    success: function(data) {
      // Check if the response has a 'status' field and if it's 'success'
      if (data.hasOwnProperty('status') && data.status === 'success') {
        // Update the questions data
        questionsData = data.questions;

        // Sort the questionsData array based on the 'question_id' in ascending order
        questionsData.sort(function(a, b) {
          return a.question_id - b.question_id;
        });

        // Display the questions links in the container
        updateQuestionLinks();

        // Load the first question by default
        loadQuestionByIndex(currentQuestionIndex);
        $("#loaderContainer").hide();
      } else {
        // Handle the error case
        showErrorAlert("Failed to fetch questions!");
        $("#loaderContainer").hide();
      }
    },
    error: function() {
      // Handle the error case
      showErrorAlert("Failed to fetch questions!");
    }, 

    complete: function() {
      // Hide the loader when the AJAX request is complete, regardless of success or error
      $("#loaderContainer").hide();
    }


  });
}

// Function to update the question links
function updateQuestionLinks() {
  var questionsHtml = '';
  questionsData.forEach(function(question, index) {
    // Add 1 to index to display numbering starting from 1
    var questionNumber = index + 1;

    // Add the class "nav-tab-color" to even li elements
    var listItemClass = index === currentQuestionIndex ? 'nav-tab-color' : '';

    questionsHtml += '<li    style=" width: 100%;" class="nav-item ' + listItemClass + '"><a href="#" class="nav-link" onclick="loadQuestionByIndex(' + index + ')">' + questionNumber + '</a></li>';
  
  
  });

  // Display the questions links in the container
  $('#navbar-nav').html(questionsHtml);

  // Update the current question number and total number of questions
  $('#current-question-no').text(currentQuestionIndex + 1);
  $('#total-question-no').text(questionsData.length);
}

function generateRandomNumber(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Function to load a question by its index
function loadQuestionByIndex(index) {

  var randomNumber=generateRandomNumber(30,100);

  

  $('#correct-ans-per').text(randomNumber+'%');

  $('#card-border').hide(); // Hide the div
  $('#hide-explanation').hide(); // Hide the div
  $('input[name="radio-group"]').prop('checked', false);
  if (index >= 0 && index < questionsData.length) {
    var question = questionsData[index];
    // Update the content in the specified elements with question details
    $('#question-text').html( question.question);
   
    $('#option-1').text(question.option1);
    $('#option-2').text(question.option2);
    $('#option-3').text(question.option3);
    $('#option-4').text(question.option4);
    $('#option-5').text(question.option5);

    // Display the correct option as A, B, C, D, E, or "Not Solved Yet"
    var correctOptionText = "";
    switch (question.correct_option) {
      case "1":
        correctOptionText = "A";
        $('#correction-option-text').css('color', 'green');
        $('#correction-option-text').text('Correct Option');
        $('#card-border').css('border-left', '5px solid green');
        
        break;
      case "2":
        correctOptionText = "B";
        $('#correction-option-text').css('color', 'green');
        $('#correction-option-text').text('Correct Option');
        $('#card-border').css('border-left', '5px solid green');
        
        break;
      case "3":
        correctOptionText = "C";
        $('#correction-option-text').css('color', 'green');
        $('#correction-option-text').text('Correct Option');
        $('#card-border').css('border-left', '5px solid green');
        
        break;
      case "4":
        correctOptionText = "D";
        $('#correction-option-text').css('color', 'green');
        $('#correction-option-text').text('Correct Option');
        $('#card-border').css('border-left', '5px solid green');
        
        break;
      case "5":
        correctOptionText = "E";
        $('#correction-option-text').css('color', 'green');
        $('#correction-option-text').text('Correct Option');
        $('#card-border').css('border-left', '5px solid green');
        
        break;
      case "6":
        correctOptionText = "Not Solved Yet";
        $('#correction-option-text').css('color', 'red');
        $('#correction-option-text').text('Incorrect Option');
        $('#card-border').css('border-left', '5px solid red');
        
        break;
      default:
        correctOptionText = "Unknown";
        break;
    }

    $('#correct-option').text( correctOptionText);
    // Update the question explanation as plain text
    $('#question-explanation').html( question.question_explanation);
    $('#question-id').text( question.question_id);

    // Update the current question index
    currentQuestionIndex = index;

    // Update the question links with the highlighted class
    updateQuestionLinks();
  }
}


// Function to load the next question
function loadNextQuestion() {
  if (currentQuestionIndex < questionsData.length - 1) {
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


$(document).ready(function() {
  // Attach a change event to all radio buttons with name "radio-group"
  $('input[name="radio-group"]').change(function() {

    var selectedValue = $('input[name="radio-group"]:checked').val();

    // Show/hide the div based on the radio button selection
    if (selectedValue) {
      
      $('#card-border').show();  // show the div
      $('#hide-explanation').show();  // show the div
    } else {
      
      $('#card-border').hide(); // Hide the div
      $('#hide-explanation').hide(); // Hide the div
    }

      
  });


  // Disable copying on keypress event
document.addEventListener('keydown', function(event) {
  if (event.ctrlKey && (event.key === 'c' || event.key === 'C')) {
    
    showErrorAlert("You have breached our terms and conditions.");
    
    event.preventDefault();
  }
});

function openPage(url) {
  window.location.href = url;
  const popupWindow = window.open(url, "PopupWindow", "width=800,height=600");
}






  });





