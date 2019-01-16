/*
 * Application.js
 * Author: Luca Cuzzolin
 * Movian Repo admin js
 * Feel free to copy this simple code :)
 *
 */
/*
 * jQuery Document Ready
 */
(function($) {

  $.noConflict();

  $(document).ready( function() {


    /*
     *  Add input
     */
    $('#movianrepo-add').on({
      click: function(e) {
        e.preventDefault();
        //console.log("clicked");
        $("#movianrepo-urls-input").append('<li><input class="urls" name="movianrepo_option_name[urls][]" /><a class="movianrepo-remove" href="javascript:void(0)">remove</a></li>');

      }

    });


    /*
     *  Remove input
     */
    $(document).on("click", "a.movianrepo-remove" , function() {
      $(this).parent('li').remove();
    });



  });

})(jQuery);
