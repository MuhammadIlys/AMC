<!DOCTYPE >
<html lang='en' >
   <head>
      <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>
         Question Preview
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






    </head>
   <body>
      <div id='root'>
         <div id='titlebar'>
            <div class='container'>
               <div id='header'>
                  <h1>
                     <a href='#'>Question Preview</a>
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

                        <div class='question'>
                            <form class="edit_answer" id="edit_answer_2585551" method="post">
                                <fieldset>
                                    <div id="question_text">
                                        {!! $question->question_text !!}
                                    </div>
                                    <ol>
                                        <li>
                                            <label for='answer_a'>
                                                <input id='answer_a' name='options' type='radio' value='1' />
                                                <span>A. <span id="option1"> {!! $question->option1 !!}</span></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_b'>
                                                <input id='answer_b' name='options' type='radio' value='2' />
                                                <span>B. <span id="option2">{!! $question->option2 !!}</span> </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_c'>
                                                <input id='answer_c' name='options' type='radio' value='3' />
                                                <span>C. <span id="option3">{!! $question->option3 !!}</span></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_d'>
                                                <input id='answer_d' name='options' type='radio' value='4' />
                                                <span>D. <span id="option4">{!! $question->option4 !!}</span></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for='answer_e'>
                                                <input id='answer_e' name='options' type='radio' value='5' />
                                                <span>E. <span id="option5">{!! $question->option5 !!}</span></span>
                                            </label>
                                        </li>
                                    </ol>
                                </fieldset>
                            </form>
                        </div>

                        <strong> Explanation</strong>

                        <hr>

                        <div id="explanation">

                            {!! $question->question_explanation !!}
                        </div>

                    </div>
                </div>
            </div>
            <div id='footer'>

                <div id='site-actions'>
                    <ul>
                        <li style="padding: 15px;">

                        </li>
                    </ul>
                </div>
            </div>

   </body>

   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
       applyFontStylesToElements('#explanation');
       observeElementChanges('#question-text');
       observeElementChanges('#option1');
       observeElementChanges('#option2');
       observeElementChanges('#option3');
       observeElementChanges('#option4');
       observeElementChanges('#option5');
       observeElementChanges('#explanation');
     });
   </script>
</html>
