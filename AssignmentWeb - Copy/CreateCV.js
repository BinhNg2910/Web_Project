let openphonenumberlist=false;  //Used to check if the user input 1 time before
let openCerDeglist=false;   //Used to check if the user input 1 time before

//Here is to print all entered phone
const phoneNumberList = document.getElementById('phoneNumberList');
const phoneNumberElement = document.createElement('p');
phoneNumberElement.textContent = 'Existed phone numbers: ';
phoneNumberList.appendChild(phoneNumberElement);
function generatePhoneNumberList(){
    for(const key in sessionStorage){
        if(key.startsWith('phoneNumber-')){
            const phoneNumber = sessionStorage.getItem(key);

            const phoneNumberElement = document.createElement('p');
            phoneNumberElement.textContent = phoneNumber;

            phoneNumberList.appendChild(phoneNumberElement);
        }
    }
}

//Here is to print all entered Certificate/Degree
const CerDegList = document.getElementById('CerDegList');
const CerDegElement = document.createElement('p');
CerDegElement.textContent = 'Existed Certificate/Degree: ';
CerDegList.appendChild(CerDegElement);
function generateCerDegList(){
    for(const key in sessionStorage){
        if(key.startsWith('CerDeg-')){
            const CerDeg = sessionStorage.getItem(key);

            const CerDegElement = document.createElement('p');
            CerDegElement.textContent = CerDeg;

            CerDegList.appendChild(CerDegElement);
        }
    }
}

window.addEventListener('beforeunload', function(){
    this.sessionStorage.clear();
});

$(document).ready(function(){
    $('#cvname').blur(function(){
        $('#submit_form_err').html('');
        checkcvname();
    });
    $('#fname').on('input', function(){
        $('#submit_form_err').html('');
        checkfname();
    });
    $('#birthday').on('input', function(){
        $('#submit_form_err').html('');
        checkbirthday();
    });
    $('#address').on('input', function(){
        $('#submit_form_err').html('');
        checkaddress();
    });
    $('#phone').on('input', function(){
        $('#submit_form_err').html('');
        checkphone();
    });
    const submitphone = document.getElementById('phone_submit');
    submitphone.addEventListener('click', function() {
        var x = document.getElementById('phone_submit');
        x.disabled=true;
        if(checkphone()==1){
            let duplicate=false;
            for(const key in sessionStorage){
                if(key.startsWith('phoneNumber-')){
                    const existedNumber = sessionStorage.getItem(key);
                    if(existedNumber===document.getElementById('phone').value){
                        duplicate=true;
                        break;
                    }
                }
            }
            if(!duplicate){
                var phone=document.getElementById('phone').value;
                sessionStorage.setItem('phoneNumber-'+phone, phone);
                $('#ModalPhone').modal('hide');
                document.getElementById('phone').value='';
                const phoneNumberElement = document.createElement('p');
                phoneNumberElement.textContent = phone;

                phoneNumberList.appendChild(phoneNumberElement);
                addPhoneinput(phone);
            } else {
                $('#phone_err').html('Already existed phone number!');
            }
        }
    });
    $('#phonebutton').on('click', function(){
        $('#submit_form_err').html('');
        if(!openphonenumberlist){
            generatePhoneNumberList();
            openphonenumberlist=true;
        }
    });
    $('#CerDegbutton').on('click', function(){
        $('#submit_form_err').html('');
        if(!openCerDeglist){
            generateCerDegList();
            openCerDeglist=true;
        }
    });
    const submitCerDeg = document.getElementById('CerDeg_submit');
    submitCerDeg.addEventListener('click', function(){
        var x = document.getElementById('CerDeg_submit');
        x.disabled=true;
        if(checkCerDeg()==1){
            let duplicate=false;
            for(const key in sessionStorage){
                if(key.startsWith('CerDeg-')){
                    const existedCerDeg = sessionStorage.getItem(key);
                    if(existedCerDeg===document.getElementById('CerDeg').value){
                        duplicate=true;
                        break;
                    }
                }
            }
            if(!duplicate){
                var CerDeg=document.getElementById('CerDeg').value;
                sessionStorage.setItem('CerDeg-'+CerDeg, CerDeg);
                $('#ModalCerDeg').modal('hide');
                document.getElementById('CerDeg').value='';
                const CerDegElement = document.createElement('p');
                CerDegElement.textContent = CerDeg;

                CerDegList.appendChild(CerDegElement);
                addCerDeginput(CerDeg);
            } else {
                $('#CerDeg_err').html('Already existed Certificate/Degree!');
            }
        }
    });

    $('#submit_form').on('click', function(){
        if(!checkcvname() || !checkfname() || !checkbirthday() || !checkaddress() || !existedphone() || !existedCerDeg() || !checkmail() || !checkwebsite()){
            $('#submit_form_err').html('Please fill/correct all required input!');
            return false;
        }
        sessionStorage.clear();
        return true;
    });

    $('#mail').on('input', function(){
        $('#submit_form_err').html('');
        checkmail();
    });
    $('#website').on('input', function(){
        checkwebsite();
    });
    $('#CerDeg').on('input', function(){
        checkCerDeg();
    });

    $('#reset').on('click', function(){
        sessionStorage.clear();
        window.location.href='CreateCV.php';
    });
});

function addPhoneinput(phoneNumber){
    const phoneNumberContainer = document.getElementById('phoneNumberContainer');
    const newPhoneNumberInput = document.createElement('input');
    newPhoneNumberInput.type = 'hidden';
    newPhoneNumberInput.name = 'phoneNumber-'+phoneNumber;
    newPhoneNumberInput.value = phoneNumber;
    phoneNumberContainer.appendChild(newPhoneNumberInput);
}

function addCerDeginput(CerDeg){
    const CerDegContainer = document.getElementById('CerDegContainer');
    const newCerDegInput = document.createElement('input');
    newCerDegInput.type = 'hidden';
    newCerDegInput.name = 'CerDeg-'+CerDeg;
    newCerDegInput.value = CerDeg;
    CerDegContainer.appendChild(newCerDegInput);
}

function existedphone(){
    for(const key in sessionStorage){
        if(key.startsWith('phoneNumber-')) return true;
    }
    return false;
}

function existedCerDeg(){
    for(const key in sessionStorage){
        if(key.startsWith('CerDeg-')) return true;
    }
    return false;
}

function checkcvname(){
    var cvname = $('#cvname').val();
    var check=false;
    if(cvname==""){
        $('#cvname_err').html('Required CV name!');
        return false;
    } else {
        $('#submit_form_err').html('');
        var input = cvname;
        if(input!=''){
            $.ajax({
                url:"validationCVname.php",
                type:"POST",
                async: false,
                data: {datane:input},
                success: function(response){
                    const parsedResponse = JSON.parse(response);
                    const message = parsedResponse.message;
                    if(message==true){
                        check=true;
                        $('#cvname_err').html("Existed CV's name!");
                    }
                }
            });
        }
        if(check==true) return false;
    }
    $('#cvname_err').html('');
    return true;
}

function checkfname(){
    var fname = $('#fname').val();
    if(fname==""){
        $('#fname_err').html('Required full name!');
        return false;
    }
    $('#fname_err').html('');
    return true;
}

function checkbirthday(){
    var today = new Date();
    var currentDate = today.getDate();
    var currentMonth = today.getMonth() + 1;
    var currentYear = today.getYear() + 1900;

    var birthday = new Date($('#birthday').val());
    var date = birthday.getDate();
    var month = birthday.getMonth() + 1;
    var year = birthday.getYear() + 1900;

    if (year == currentYear){
        if(month==currentMonth){
            if(date > currentDate){
                $('#birthday_err').html('Invalid date of birth');
                return false;
            }
        } else if(month>currentMonth){
            $('#birthday_err').html('Invalid date of birth');
            return false;
        }
    } else if(year>currentYear){
        $('#birthday_err').html('Invalid date of birth');
        return false;
    }
    $('#birthday_err').html('');
    return true;
}

function checkaddress(){
    var address = $('#address').val();
    if(address==""){
        $('#address_err').html('Required Address!');
        return false;
    }
    $('#address_err').html('');
    return true;
}

function checkphone(){
    let input = $('#phone').val();
    const regex= /^[0-9]{8,11}$/g;
    if(!input.match(regex)){
        $('#phone_err').html('Invalid phone number(s)');
        return false;
    }
    document.getElementById('phone_submit').disabled=false;
    $('#phone_err').html('');
    return true;
}

function checkmail(){
    let input = $('#mail').val();
    const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(!input.match(regex)){
        $('#mail_err').html('Invalid mail address!');
        return false;
    }
    $('#mail_err').html('');
    return true;
}

function checkwebsite(){
    let input = $('#website').val();
    const regex = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/;
    if(!input.match(regex)){
        if(input==''){
            $('#website_err').html('');
            return true;
        }
        $('#website_err').html('Invalid website address!');
        return false;
    }
    $('#website_err').html('');
    return true;
}

function checkCerDeg(){
    if($('#CerDeg').val()==''){
        $('#CerDeg_err').html('Empty space! You can not submit, please try again!');
        return false;
    }
    document.getElementById('CerDeg_submit').disabled=false;
    $('#CerDeg_err').html('');
    return true;
}