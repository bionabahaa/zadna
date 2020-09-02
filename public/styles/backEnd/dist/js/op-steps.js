 $(document).ready(function() {

     $(".panel input").attr("required", "required");
     $(".panel select").attr("required", "required");
     $(".panel select").attr("required", "required");

     var navListItems = $('div.setup-panel div a'),
         allWells = $('.setup-content'),
         allNextBtn = $('.nextBtn'),
         allPrevBtn = $('.prevBtn');

     allWells.hide();

     navListItems.click(function(e) {
         e.preventDefault();
         var $target = $($(this).attr('href')),
             $item = $(this);
         var nextStepWizard = $(this).text();

         if (nextStepWizard == 1)
             $('.stepwizard .progress-bar').animate({
                 width: '0%'
             }, 0);
         if (nextStepWizard == 2)
             $('.stepwizard .progress-bar').animate({
                 width: '22%'
             }, 0);
         if (nextStepWizard == 3)
             $('.stepwizard .progress-bar').animate({
                 width: '33%'
             }, 0);
         if (nextStepWizard == 4)
             $('.stepwizard .progress-bar').animate({
                 width: '49%'
             }, 0);
         if (nextStepWizard == 5)
             $('.stepwizard .progress-bar').animate({
                 width: '63%'
             }, 0);
         if (nextStepWizard == 6)
             $('.stepwizard .progress-bar').animate({
                 width: '78%'
             }, 0);
         if (nextStepWizard == 7)
             $('.stepwizard .progress-bar').animate({
                 width: '94%'
             }, 0);

         if (nextStepWizard == 11)
             $('.stepwizard2 .progress-bar').animate({
                 width: '11%'
             }, 0);
         if (nextStepWizard == 22)
             $('.stepwizard2 .progress-bar').animate({
                 width: '36%'
             }, 0);
         if (nextStepWizard == 33)
             $('.stepwizard2 .progress-bar').animate({
                 width: '60%'
             }, 0);
         if (nextStepWizard == 44)
             $('.stepwizard2 .progress-bar').animate({
                 width: '86%'
             }, 0);



         if (!$item.hasClass('disabled')) {
             navListItems.removeClass('btn-success').addClass('btn-default');
             //navListItems.addClass('btn-default');
             $item.addClass('btn-success');
             allWells.hide();
             $target.show();
             $target.find('input:eq(0)').focus();
         }
     });

     allNextBtn.click(function() {
         var curStep = $(this).closest(".setup-content"),
             curStepBtn = curStep.attr("id"),
             nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next()
             .children("a"),
             curInputs = curStep.find("[required='required']"),
             // curInputs = curStep.find(""),
             isValid = true;

         $(".form-group").removeClass("has-error");
         $(".error-txt").text("");

         for (var i = 0; i < curInputs.length; i++) {
             if (!curInputs[i].validity.valid) {
                 isValid = false;
                 $(curInputs[i]).closest(".form-group").addClass("has-error");
                 $(curInputs[i]).closest(".form-group").parents("tr").find(".error-txt").text(
                     "Please fill this field")
             }
         }

         if (isValid) {
             nextStepWizard.removeAttr('disabled').trigger('click');
         }
     });


     allPrevBtn.click(function() {
         var curStep = $(this).closest(".setup-content"),
             curStepBtn = curStep.attr("id"),
             prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev()
             .children("a");

         prevStepWizard.removeAttr('disabled').trigger('click');
     });


     $('div.setup-panel div a.btn-success').trigger('click');
 });