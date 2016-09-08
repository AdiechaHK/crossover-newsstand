
// Default page calling starts from 1 in load more
var PAGE = 1;

$(document).ready(function() {

  // Load more news
  $("#load-more").click(function() {
    var self = this;
    var url = $(self).data('url') + "/" + PAGE++;
    $.get(url).then(function(res) {
      if(res == "") {
        $(self).remove();
        alert("There is no more news to show.");
      } else {
        $("#news-container").append(res);
      }
    });
  });

  // Ask for confirmation before really delete the news
  $(".delete-form").submit(function() {
    return confirm("Are you sure ?");
  });

});