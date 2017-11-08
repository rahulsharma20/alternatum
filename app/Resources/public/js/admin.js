$(document).ready(function(){
    $(".assign_user").unbind('click');
    $('.assign_user').click(function(){
        var base_url = window.location.origin;
        var data = {
            'user_id': $(this).attr('userid'),
            'building_id': $(this).attr('buildingid')
        }
        if (this.checked === true) {
            var success_msg = 'User has been assigned to the building';
            var error_msg = 'Error assigning user to building.'
            $.ajax({
                type: "POST",
                url: base_url + '/_internal/admin/assign/user/building',
                data: JSON.stringify(data),
                dataType: "json",
                success: function (response) {
                    // Show success message
                    if (response.code === 200) {
                        alert(success_msg);
                    }
                    // Show error message
                    else {
                        alert(error_msg);
                    }
                    return;
                },
                error: function (error) {
                    alert(error_msg);

                    return;
                }
            });
        } else {
            var success_msg = 'User has been removed from the building';
            var error_msg = 'Error removing user from building.'
            $.ajax({
                type: "POST",
                url: base_url + '/_internal/admin/remove/user/building',
                data: JSON.stringify(data),
                dataType: "json",
                success: function (response) {
                    // Show success message
                    if (response.code === 200) {
                        alert(success_msg);
                    }
                    // Show error message
                    else {
                        alert(error_msg);
                    }
                    return;
                },
                error: function (error) {
                    alert(error_msg);

                    return;
                }
            });
        }
    })
});
