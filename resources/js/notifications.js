$(document).ready(function () {
    // Fetch the notification count and update the badge
    setInterval(function() {
        $.ajax({
            url: '/admin/requests/count', // Endpoint to get the count of pending requests
            method: 'GET',
            success: function (data) {
                var badge = $('.nav-link-lg .badge');
                if (data.count > 0) {
                    badge.text(data.count).show();
                } else {
                    badge.hide();
                }
            }
        });
    }, 60000); // Update every minute
});
