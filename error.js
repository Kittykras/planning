$(document).ready(function() {
    $('#registerForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                userName: {
                    validators: {
                        notEmpty: {
                            message: 'Brugernavn er ikke udfyldt'
                        },
                        remote: {
                            url: '/examples/adding-warning-validation-state/test.json'
                        }
                    }
                }
            }
        })
        // This event will be triggered when the field passes given validator
        .on('success.validator.fv', function(e, data) {
            // data.field     --> The field name
            // data.element   --> The field element
            // data.result    --> The result returned by the validator
            // data.validator --> The validator name

            if (data.field === 'newUser'
                && data.validator === 'remote'
                && (data.result.available === false || data.result.available === 'false'))
            {
                // The userName field passes the remote validator
                data.element                    // Get the field element
                    .closest('.form-group')     // Get the field parent

                    // Add has-warning class
                    .removeClass('has-success')
                    .addClass('has-warning')

                    // Show message
                    .find('small[data-fv-validator="remote"][data-fv-for="newUser"]')
                        .show();
            }
        })
        // This event will be triggered when the field doesn't pass given validator
        .on('err.validator.fv', function(e, data) {
            // We need to remove has-warning class
            // when the field doesn't pass any validator
            if (data.field === 'newUser') {
                data.element
                    .closest('.form-group')
                    .removeClass('has-warning');
            }
        });
});