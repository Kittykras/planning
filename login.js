            $(function() {
 
                if (localStorage.chkbx && localStorage.chkbx != '') {
                    $('#remember_me').attr('checked', 'checked');
                    $('#user').val(localStorage.user);
                    $('#pwd').val(localStorage.pwd);
                } else {
                    $('#remember_me').removeAttr('checked');
                    $('#user').val('');
                    $('#pwd').val('');
                }
 
                $('#remember_me').click(function() {
 
                    if ($('#remember_me').is(':checked')) {
                        // save username and password
                        localStorage.user = $('#user').val();
                        localStorage.pwd = $('#pwd').val();
                        localStorage.chkbx = $('#remember_me').val();
                    } else {
                        localStorage.user = '';
                        localStorage.pwd = '';
                        localStorage.chkbx = '';
                    }
                });
            });
 