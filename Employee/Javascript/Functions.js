function checkdataMOBILE() {
    mobnumberbox = document.getElementById('mobile');
    var mobnumber =mobnumberbox.value;
    var numberlebal = document.getElementById('notnumber');
    numberlebal.textContent="";
    i=0;
    var data = new FormData();
    if(mobnumber!='')
    {
        if(!isNaN(mobnumber) && !isNaN(parseFloat(mobnumber)))
        {
            if(mobnumber.length === 10)
            {
                data.append('Mobile', mobnumber);
                mobnumberbox.style.borderColor='#d2d6de';
            }
            else
            {
                mobnumberbox.style.borderColor='red';
                numberlebal.textContent="Mobile number must be 10 digits";
            }
        }
        else
        {
            mobnumberbox.style.borderColor='red';
            numberlebal.textContent="Enter a valid Mobile number ";
        }
    }
    else
    {
        mobnumberbox.style.borderColor='red';
        numberlebal.textContent="Mobile number can't be empty";
    }
    var xhr = new XMLHttpRequest();
    var url = "email_phone_check.php";
    xhr.open("POST", url, true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Check the response from PHP
            var response = xhr.responseText.split(',');
            var phonedata = parseInt(response[1]);
            if (phonedata != 404) {
                if(phonedata==0)
                {
                    mobnumberbox.style.borderColor='green';
                    i=1;
                }
                else
                {
                    numberlebal.textContent="Mobile number already exists";
                }
            } else {
                return false;
            }
            if(i==1)
            {
                if(checkform())
                {
                    document.getElementById("register").submit();
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
    };
    xhr.send(data);
}
function checkform()
{
    a=[]
    b=[]
    gender=document.getElementById('gender');
    value1=document.getElementById('name');
    value2=document.getElementById('address');
    value3=document.getElementById('dob');
    valuema=document.getElementById('radiodatamale');
    valuefe=document.getElementById('radiodatafemale');
    b.push(value1,value2,value3)
    a.push(value1.value,value2.value,value3.value)
    co=0
    for(i=0;i<3;i++)
    {
        if(a[i]=='')
        {
            co=1
            b[i].style.borderColor='red';
        }
        else
        {
            b[i].style.borderColor='#d2d6de';
        }
    }
    if(valuema.checked || valuefe.checked)
    {
        gender.style.color='black';
    }
    else
    {
        co=1;
        gender.style.color='red';
    }
    if(co==1)
    {
        return false;
    }
    else
    {
        return true;
    }
}