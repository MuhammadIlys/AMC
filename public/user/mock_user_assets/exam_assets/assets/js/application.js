// Place your application-specific JavaScript functions and classes here
// This file is automatically included by javascript_include_tag :defaults

String.prototype.pad = function(l, s, t){
    return s || (s = " "), (l -= this.length) > 0 ? (s = new Array(Math.ceil(l / s.length)
        + 1).join(s)).substr(0, t = !t ? l : t == 1 ? 0 : Math.ceil(l / 2))
        + this + s.substr(0, l - t) : this;
};

jQuery(document).ready(function($) {

  $('a[rel*=facebox]').openDOMWindow({
    eventType:'click',
    loader:0,
    loaderImagePath:'animationProcessing.gif',
    loaderHeight:16,
    loaderWidth:17
  });
  //$('a[rel*=facebox]').facebox();
  if ($("#time").length == 1) {
    update_time();
  }
})
var time_remaining_counter = 0;
var answering_question = false;
function update_time() {
  new_time_left = time_remaining - time_remaining_counter;
  time_remaining_counter++;
  if (new_time_left < 0) {
    document.location.href = "/exams/" + exam_id;
  }
  $("#time").html(format_time_remaining(new_time_left));
  window.setTimeout("update_time()",1000);
}
function format_time_remaining(tr) {
  if (tr > 0) {
    minutes = Math.floor(tr / 60);
    seconds = tr % 60;
    return minutes + ":" + String(seconds).pad(2,"0");
  } else {
    return "0:00";
  }
}
var seen_bottom_of_page = false;

$(document).ready(function() {
    function isScrolledIntoView(elem) {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();

        var elemTop = $(elem).offset().top;
        var elemBottom = elemTop + $(elem).height();

        return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
    }

    var myelement = $('#bottom_of_page'); // the element to act on if viewable
    $(window).scroll(function() {
        if(isScrolledIntoView(myelement)) {
            seen_bottom_of_page = true;
        }
    });
    // run it once onload
    if(isScrolledIntoView(myelement)) {
        seen_bottom_of_page = true;
    }

});


function check_client_side_validations() {
  if (seen_bottom_of_page == false) {
    show_popup('#scroll_down');
    return false;
  }
  if ($("input[type=radio]:checked").length == 0) {
    //jQuery.facebox('Please choose an answer to proceed');
    show_popup('#please_answer');
    return false;
  }
  return true;
}

function show_popup(dom_id) {
  //$('#DOMWindow').remove();
  $.openDOMWindow({windowSourceID:dom_id,
    overlay: 1,
    height: 150,
    modal: 1,
    borderColor:'#769179',
    borderSize:'10',
    overlayOpacity:8
  });
  return true;
}

function close_popup(dom_id) {
  $.closeDOMWindow({windowSourceID:dom_id, closeNow: 1})
  //$('#DOMWindow').remove();
  return true;
}

function check_copyright_acceptance(url) {
  selected_radios = $("input:checked");
  if ($($("input:checked")[0]).val() == "Y") {
    document.location.href = url;
    return true;
  } else {
    show_popup('#end_exam');
  }
  return false;
}

function check_instructions_acceptance(exam_id) {
  if (answering_question == false) {
    answering_question = true;
    $.post("/exams/" + exam_id,{"_method": "put", "aasm_event": "display_sample_question_1!", authenticity_token: authenticity_token},function() {
      document.location.href = "/exams/" + exam_id;
    })
    return false;
  }
}

function check_sample_question_1() {
  if (answering_question == false) {
    if (check_client_side_validations()) {
      answering_question = true;
      $.post("/exams/" + exam_id,{"_method": "put", "aasm_event": "display_sample_question_2!", authenticity_token: authenticity_token},function() {
        document.location.href = "/exams/" + exam_id;
      });    
    }
  }
  return false;
}
function check_sample_question_2() {
  if (answering_question == false) {
    if (check_client_side_validations()) {
      answering_question = true;
      $.post("/exams/" + exam_id,{"_method": "put", "aasm_event": "display_copyright!", authenticity_token: authenticity_token},function() {
        document.location.href = "/exams/" + exam_id;
      })      
    }
  }
  return false;
}

function submit_answer_form(commit) {
  if (answering_question == true) {
    return false;
  }
  answering_question = true;
  $("#form_commit").remove();
  $(".edit_answer").append("<input type='hidden' name='commit' value='" + commit + "' id='form_commit'/>");
  if (check_client_side_validations()) {
    // set the question they answered
    answered = get_radio_checked()
    $(".edit_answer").append("<input type='hidden' name='answer[answer]' value='" + answered + "'/>");
    $(".edit_answer").submit();
  } else {
    answering_question = false;
  }
}

function get_radio_checked() {
  var checked = undefined;
  $("input[type=radio]").each(function(x) {
    if (this.checked == true) {
      checked = String.fromCharCode(65 + x);
    }
  })
  return checked;
}

function end_exam(){
  show_popup('#end_exam');
}

function hide_end_exam() {
  close_popup('#end_exam');
  window.setTimeout("show_popup('#end_exam_1');",100);
}

function really_end_exam_no_copyright() {
  $.post("/exams/" + exam_id,{"_method": "put", "aasm_event": "exam_was_ended_no_copyright!", authenticity_token: authenticity_token},function() {
    document.location.href = "/exams/" + exam_id;
    close_popup('#end_exam_1');
  })
}

function really_end_exam() {
  $.post("/exams/" + exam_id,{"_method": "put", "aasm_event": "exam_was_ended!", authenticity_token: authenticity_token},function() {
    document.location.href = "/exams/" + exam_id;
    close_popup('#end_exam_1');
  })
}

function end_review(){
  show_popup('#end_review');
}

function hide_end_review() {
  close_popup('#end_review');
  window.setTimeout("show_popup('#end_review_1');",100);
}


function really_end_review() {
  close_popup('#end_review_1');
  $.post("/exams/" + exam_id,{"_method": "put", "aasm_event": "show_survey_questions!", authenticity_token: authenticity_token},function() {
    document.location.href = "/exams/" + exam_id;
  })
}


function flag_answer(id) {
  eval('flag_it = (answer_' + id + '_flagged == true) ? "0" : "1";');
  if (flag_it == "1") {
    $("#flag_for_review").addClass("flagged");
    $("#answer_" + id).removeClass("flagoff");
    $("#answer_" + id).addClass("flagon");
  } else {
    $("#flag_for_review").removeClass("flagged");
    $("#answer_" + id).removeClass("flagon");
    $("#answer_" + id).addClass("flagoff");
  }

  $.post("/exams/" + exam_id + "/answers/" + id + "/toggle_flagged.js" ,{"_method": "put", "answer[flagged]": flag_it, authenticity_token: authenticity_token},function() {
    if (flag_it == "0") {
      eval('answer_' + id + '_flagged = false;');
    } else {
      eval('answer_' + id + '_flagged = true;');
    }
  })
}
function review_all_questions(id) {
  $.post("/exams/" + exam_id,{"_method": "put", "exam[state]": "answering_questions", "exam[current_step]": "0", authenticity_token: authenticity_token},function(data) {
    document.location.href = "/exams/" + exam_id;
  })
}

function review_flagged_questions(id) {
  $.post("/exams/" + exam_id,{"_method": "put", "aasm_event": "review_flagged_questions!", authenticity_token: authenticity_token},function(data) {
    document.location.href = "/exams/" + exam_id;
  })
}

function go_to_review_screen(id) {
  $.post("/exams/" + exam_id,{"_method": "put", "aasm_event": "review_exam!", authenticity_token: authenticity_token},function(data) {
    document.location.href = "/exams/" + exam_id;
  })
}

$(function(){
  var a = $("a[href=mailto:amc+error@amc.org.au]"),
      href = a.attr('href'),
      subject = 'AMC Trial Exam Error',
      browser = '[unrecognisable]',
      body = "%0A%0A--%0ABrowser: ";

  for(var b in $.browser) {
    if ($.browser[b] === true) {
      body = b;
      break;
    }
  }

  body += [browser, $.browser.version].join(' v');
  body += " (please don't change)";

  href += "?subject=" + subject;
  href += "&body=" + body;

  a.attr('href',href);
});