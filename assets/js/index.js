var i=2; 
$(document).ready(function(){   
    $('#add').click(function(){  
       i++; 
       document.getElementById("userCount").value = i;
       $('#dynamic_field').append('<div id="row'+i+'"><div class="form-group row"><label class="col-sm-3 col-form-label">Users Name</label><div class="col-sm-6 d-inline"><input class="form-control col-sm-11" type="text" name="user'+i+'Name" placeholder="Users Name" required><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove col-sm-1">X</button></div></div><div class="form-group row"><label class="col-sm-3 col-form-label">User Current and Previous Usage</label><div class="col-sm-6"><input class="form-control" type="number" name="user'+i+'PrvUsage" placeholder="Previous Usage (kWh)" required min=1 step=".01"><input class="form-control" type="number" name="user'+i+'CurUsage" placeholder="Current Usage (kWh)" required min=1 step=".01"><br><br></div></div></div>');  
    }); 
    $(document).on('click', '.btn_remove', function(){ 
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();  
    });  
});  

    function add_number(e) {
        if (isNumberKey(e)) {
            setTimeout(() => {
            var totalWatt = document.getElementById("totalWatt").value !== "" ? parseInt(document.getElementById("totalWatt").value) : 1;
            var totalPrice = document.getElementById("totalPrice").value !== "" ? parseInt(document.getElementById("totalPrice").value) : 1;
            if(totalPrice||totalWatt < 0){
                var result = totalPrice / totalWatt;
            }else{
                var result = "ERROR";
            }
            console.log(result);
            document.getElementById("ppu").value = result.toFixed(2);
            }, 50)
            return true;
        } else {
            return false;
        }
    }

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }