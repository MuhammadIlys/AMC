function tourfunc() {
    var $mark_container = '<h5 class="text-muted">Mark questions to review later</h5> <div class="num-total text-muted">1 to 15</div>';
    var $previous_btn_container = '<h5 class="text-muted">Navigate to previous question using the previous button</h5> <div class="num-total text-muted">2 to 15</div>';
    var $next_btn_container = '<h5 class="text-muted">Navigate to next question using the next button</h5> <div class="num-total text-muted">3 to 15</div>';
    var $full_screen_container = '<h5 class="text-muted">Toggle between full screen view and regular view</h5> <div class="num-total text-muted">4 to 15</div>';
    var $lab_values = '<h5 class="text-muted">Reference sheet for lab values</h5> <div class="num-total text-muted">5 to 15</div>';
    var $notes = '<h5 class="text-muted">Add important things to notes</h5> <div class="num-total text-muted">6 to 15</div>';
    var $calculator = '<h5 class="text-muted">Provides access to calculator</h5> <div class="num-total text-muted">7 to 15</div>';
    var $reverse_color = '<h5 class="text-muted">Adjust your color preference using the reverse color option</h5> <div class="num-total text-muted">8 to 15</div>';
    var $text_zoom = '<h5 class="text-muted">Adjust your font size using the text zoom option</h5> <div class="num-total text-muted">9 to 15</div>';
    var $settings = '<h5 class="text-muted">Adjust your preferences using the settings option</h5> <div class="num-total text-muted">10 to 15</div>';
    var $my_notebook = '<h5 class="text-muted">Add key concepts, tables, and images to your Notebook for later review.</h5> <div class="num-total text-muted">11 to 15</div>';
    var $flashcard = '<h5 class="text-muted">Add important concepts/images to flashcards</h5> <div class="num-total text-muted">12 to 15</div>';
    var $feedback = '<h5 class="text-muted">Provide feedback on an individual question</h5> <div class="num-total text-muted">13 to 15</div>';
    var $suspend = '<h5 class="text-muted">Suspend test to resume later</h5> <div class="num-total text-muted">14 to 15</div>';
    var $endblock = '<h5 class="text-muted">End the test</h5> <div class="num-total text-muted">15 to 15</div>';

    var tour = new Shepherd.Tour({
        defaultStepOptions: {
            cancelIcon: {enabled: !0},
            classes: "shadow-md bg-purple-dark",
            scrollTo: {behavior: "smooth", block: "center"}
        }, useModalOverlay: {enabled: !0}
    });
    document.querySelector("#mark-tour") && tour.addStep({
        // title: $container,
        text: $mark_container,
        attachTo: {element: "#mark-tour", on: "right"},
        buttons: [{ action: '', text: "Back", classes: "btn btn-default btn-back" },{text: "Next", classes: "btn btn-primary btn-tour", action: tour.next},]
    }),
    document.querySelector("#previous-btn-tour") && tour.addStep({
        // title: "Login your account",
        text: $previous_btn_container,
        attachTo: {element: "#previous-btn-tour", on: "right"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#next-btn-tour") && tour.addStep({
        // title: "Login your account",
        text: $next_btn_container,
        attachTo: {element: "#next-btn-tour", on: "right"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#full-screen-tour") && tour.addStep({
        // title: "Login your account",
        text: $full_screen_container,
        attachTo: {element: "#full-screen-tour", on: "right"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#lab-values") && tour.addStep({
        // title: "Login your account",
        text: $lab_values,
        attachTo: {element: "#lab-values", on: "right"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#notes") && tour.addStep({
        // title: "Login your account",
        text: $notes,
        attachTo: {element: "#notes", on: "right"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#calculator") && tour.addStep({
        // title: "Login your account",
        text: $calculator,
        attachTo: {element: "#calculator", on: "right"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#reverse-color") && tour.addStep({
        // title: "Login your account",
        text: $reverse_color,
        attachTo: {element: "#reverse-color", on: "right"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#text-zoom") && tour.addStep({
        // title: "Login your account",
        text: $text_zoom,
        attachTo: {element: "#text-zoom", on: "right"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#settings") && tour.addStep({
        // title: "Login your account",
        text: $settings,
        attachTo: {element: "#settings", on: "right"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#my-notebook") && tour.addStep({
        // title: "Login your account",
        text: $settings,
        attachTo: {element: "#my-notebook", on: "left"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#flashcard") && tour.addStep({
        // title: "Login your account",
        text: $flashcard,
        attachTo: {element: "#flashcard", on: "left"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#feedback") && tour.addStep({
        // title: "Login your account",
        text: $feedback,
        attachTo: {element: "#feedback", on: "left"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#suspend") && tour.addStep({
        // title: "Login your account",
        text: $suspend,
        attachTo: {element: "#suspend", on: "left"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Next",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }),
    document.querySelector("#endblock") && tour.addStep({
        // title: "Login your account",
        text: $endblock,
        attachTo: {element: "#endblock", on: "left"},
        buttons: [{text: "Back", classes: "btn btn-default btn-back", action: tour.back}, {
            text: "Done",
            classes: "btn btn-primary btn-tour",
            action: tour.next
        }]
    }), tour.start();
}