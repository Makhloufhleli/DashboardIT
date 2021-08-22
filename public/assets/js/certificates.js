var $renewalMode;
var $creationDate;
var $renewalDate;

$renewalMode = $('#certificates_renewalMode').val();
$creationDate = new Date($('#certificates_creationDate').val());
$(document).ready(function () {
    $('#host').hide();
    $('#domain').hide();
    if($('input[type=radio][name=product]:checked').val() === 'domain'){
        console.log($('input[type=radio][name=product]').val());
        $('#domain').show();
        $('#host').hide();
    }
    if($('input[type=radio][name=product]:checked').val() === 'host'){
        console.log($('input[type=radio][name=product]').val());
        $('#host').show();
        $('#domain').hide();
    }
    Date.prototype.dateToInput = function () {
        return $creationDate.getFullYear() + 1 + '-' + ('0' + ($creationDate.getMonth() + 1)).substr(-2, 2) + '-' + ('0' + $creationDate.getDate()).substr(-2, 2);
    };
    var date = new Date();
    $renewalDate = date.dateToInput();
    if ($renewalMode === "auto") {

        $('#certificates_renewalDate').val($renewalDate);
        $('#certificates_renewalDate').prop('disabled', 'disabled');
    }

    $('#certificates_renewalMode').change(function () {
        $renewalMode = $('#certificates_renewalMode').val();
        if ($renewalMode === "auto") {

            $creationDate = new Date($('#certificates_creationDate').val());
            $renewalDate = date.dateToInput();
            $('#certificates_renewalDate').val($renewalDate);
            $('#certificates_renewalDate').prop('disabled', 'disabled');
        } else if ($renewalMode === "manual") {

            $('#certificates_renewalDate').val("");
            $('#certificates_renewalDate').prop('disabled', false);
        }
    });

    $('input[type=radio][name=product]').change(function () {
        if (this.value === 'domain') {
            $('#domain').show();
            $('#host').hide();

        }
        if (this.value === 'host') {
            $('#domain').hide();
            $('#host').show();
        }
    });

    $('#certificates_creationDate').change(function () {
        if ($renewalMode === "auto") {
            $creationDate = new Date($('#certificates_creationDate').val());
            $renewalDate = date.dateToInput();
            $('#certificates_renewalDate').val($renewalDate);
        }
    });

    /*
     $creationDate = new Date($('#certificates_creationDate').val());
     
     Date.prototype.dateToInput = function () {
     return $creationDate.getFullYear() + 1 + '-' + ('0' + ($creationDate.getMonth() + 1)).substr(-2, 2) + '-' + ('0' + $creationDate.getDate()).substr(-2, 2);
     }
     var date = new Date();
     $renewalDate = date.dateToInput();
     $('#certificates_renewalDate').val($renewalDate);
     
     */




});
