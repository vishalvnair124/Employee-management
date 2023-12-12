
function checkvalid()
{
    a=[]
    b=[]
    value1=document.getElementById('user');
    value3=document.getElementById('name');
    value4=document.getElementById('email');
    b.push(value1,value3,value4)
    a.push(value1.value,value3.value,value4.value)
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
    if(co==1)
    {
    }
    else
    {
        add_new_page()
    }
}
function add_new_page()
{
    const addempdata = document.querySelector('.addempin'); 
    if (addempdata.classList.contains('active')) {
        addempdata.classList.remove('active');
      } else {
        addempdata.classList.add('active');
      }
}
joinvalue=0;
function submitemp()
{
    checktofromdata()
    if(joinvalue==1)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function joincheck()
{
    joinvalue=document.getElementById('joindata');
    fromdate=document.getElementById('fromdata');
    dateva=joinvalue.value
    let month_date = dateva.substring(0, dateva.lastIndexOf("-"));
    fromdate.value=month_date;
}
function checktofromdata()
{
    fromdate=document.getElementById('fromdata');
    todate=document.getElementById('todata');
    datevalid=document.getElementById('notvaliddate');
    datevalid.textContent="";
    if(fromdate.value<=todate.value)
    {
        todate.style.borderColor = '#d2d6de';
        joinvalue=1;
    }
    else
    {
        todate.style.borderColor = 'red';
        joinvalue=0;
        datevalid.textContent="Invalid Designation Date";
    }
}


function checktofromfirst()
{
    oldto=document.getElementById('oldto');
    newfrom=document.getElementById('newfrom');
    var yeartemp = oldto.value.substr(0, 4);
    var monthtemp= oldto.value.substr(5);
    var month = (parseInt(monthtemp, 10)+1);
    var year  = (parseInt(yeartemp, 10));
    if(month>12)
    {
        month=1;
        year=year+1;
    }
    month=month.toString().padStart(2, '0');
    newfrom.value=year+"-"+month;
    checktofromsec();
}
checkvalue=0;
function checktofromsec()
{
    newfrom1=document.getElementById('newfrom');
    newto1=document.getElementById('newto');
    oldfrom1=document.getElementById('oldfrom');
    oldto1=document.getElementById('oldto');
    invalid=document.getElementById('not_valid');
    invalid2=document.getElementById('not_validfi');
    if(oldto1.value>=oldfrom1.value)
    {
        invalid2.textContent="";
        oldto1.style.borderColor = '#d2d6de';
        if(newfrom1.value>=newto1.value)
        {
            newto1.style.borderColor = 'red';
            invalid.textContent="Invalid Designation Date";
            checkvalue=0;
        }
        else
        {
            newto1.style.borderColor = '#d2d6de';
            invalid.textContent="";
            checkvalue=1;
        }
    }
    else
    {
        invalid2.textContent="Invalid Designation Date";
        oldto1.style.borderColor = 'red';
        checkvalue=0;
    }
    
}
function thesubmitfun()
{
    if(checkvalue==0)
    {
        checktofromsec();
        return false;
    }
    else
    {
        return true;
    }
}
function checkdataEMAIL() {
    emailbox = document.getElementById('email');
    var email =emailbox.value;
    var emaillebal = document.getElementById('notemail');
    emaillebal.textContent="";
    i=0;
    var data = new FormData();
    if(email!='')
    {
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if(emailPattern.test(email))
        {
            data.append('Email', email);
            emailbox.style.borderColor='#d2d6de';
        }
        else
        {
            emailbox.style.borderColor='red';
            emaillebal.textContent="Enter a valid Email";
        }
    }
    else
    {
        emailbox.style.borderColor='red';
        emaillebal.textContent="Email can't be empty";
    }
    var xhr = new XMLHttpRequest();
    var url = "Edit_code/email_phone_check.php";

    xhr.open("POST", url, true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Check the response from PHP
            var response = xhr.responseText.split(',');
            var emaildata = parseInt(response[0]);

            if (emaildata != 404) {
                if(emaildata==0)
                {
                    emailbox.style.borderColor='green';
                    i=1;
                }
                else
                {
                    emaillebal.textContent="Email already exists";
                }
            } else {
                return 0;
            }
            if(i==1)
            {
                checkvalid();
            }
            else
            {
                return 0;
            }
        }
    };
    xhr.send(data);
}
function holidays(st, mid, k) {
    $.ajax({
        url: "Edit_code/holi.php",
        method: "POST",
        data: {st: st, mid: mid, k: k },
        success: function() {
            location.reload();
        }
    });
}
