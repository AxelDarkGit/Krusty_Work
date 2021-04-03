async function loaded() {
  let values = {
    tblName: 'usuario'

  };

  let data = await getRequest('http://localhost/Dist/Krusty_Work/Backend/get.php', values);
  console.log(data);
}

async function clickeado() {
  let values = {
    nombre: document.getElementById('nombre').value
  };

  let data = await postRequest('http://localhost/Dist/Krusty_Work/Backend/post.php', values)
  console.log(data);
}

async function verifyUser() {
  // Declare table name to request all entries from.
  let values = {
    tblName: 'usuario'
  };
  // Get all entries from tblName
  let data = await getRequest('http://localhost/Dist/Krusty_Work/Backend/get.php', values);

  // Verify that entered email exists in the database (search through all entries in data)
  var emailFound;
  for(var i=0; i<data.data.length; i++) {
      if(emailFound = Object.entries(data.data[i]).find(pair =>
        pair[0] === 'usuario_correo' &&
        pair[1] === document.getElementById('uname').value
      )) break;
  }

  if (!emailFound) {
    console.log("Error: Correo no registrado en la base de datos de usuarios...");
  }
  else {
    // If the email is found in the database, generate unique token (TODO)
    var token = createToken(8);

    // Insert request into the database (in tblName) with emailFound and token
    let values = {
      tblName: 'reinicio_contra',
      reinicio_correo: emailFound[1],
      reinicio_fechac: getCurrentDate(),
      reinicio_token: token
    };
    let data = await postRequest('http://localhost/Dist/Krusty_Work/Backend/post.php', values)
    
    // Verify query success by checking new entry ID from database (in tblName)
    var newID;
    if(newID = Object.entries(data).find(pair => pair[0] === 'id' && pair[1] != 0)) {
      // Sent email to emailFound with generated unique token (TODO)
      //document.action="e-mail/email.php"
      console.log('Correo con token enviado!');
      console.log(data);
    }
    else {
      console.log("Error: No se pudo generar petición de reinicio de contraseña!");
    }
  }
}

async function loadToken() {
  // Disable button button by default
  const button = document.getElementById('submitSave');
  button.disabled = true;
  // Declare table name to request all entries from.
  let values = {
    tblName: 'reinicio_contra'
  };
  // Get all entries from reinicio_contra
  let data = await getRequest('http://localhost/Dist/Krusty_Work/Backend/get.php', values);

  // Get URL parameters (token expected)
  const urlParams = new URLSearchParams(window.location.search);

  if(urlParams.has('token')){
    // Verify that URL token exists in the database (search through all entries in data)
    var tokenFound, indexEntry;
    for(var i=0; i<data.data.length; i++) {
        if(tokenFound = Object.entries(data.data[i]).find(pair =>
          pair[0] === 'reinicio_token' &&
          pair[1] === urlParams.get('token')
        )) {
          indexEntry = i;
          break;
        }
    }
    // When token has been found
    if(tokenFound) {
      // Verify time validity of the token, more than 1 hour difference and token is invalid.
      var curDate = new Date();
      var sqlDate = new Date(Date.parse(data.data[indexEntry].reinicio_fechac.replace(/[-]/g,'/')));
      var difHour = Math.abs(curDate - sqlDate) / 36e5;

      if(difHour < 1) {
        button.disabled = false;
        console.log("Valid token!");
      }
      else {
        console.log("Error: Token has expired!");
      }
    }
    else {
      console.log("Error: Invalid token!");
    }
  }
  else {
    console.log("Error: Invalid or missing token!");
  }
}

async function saveNewPsw() {
  if((document.getElementById('contra1').value === "" ||
    document.getElementById('contra2').value === "") ||
    document.getElementById('contra1').value != document.getElementById('contra2').value
  ) {
      console.log("Error: Invalid password!");
  }
  else {
    // Get URL parameters (token expected)
    const urlParams = new URLSearchParams(window.location.search);

    let values = {
      tblName: 'usuario',
      usuario_correo: urlParams.get('email'),
      usuario_contra: document.getElementById('contra2').value
    };

    let data = await postRequest('http://localhost/Dist/Krusty_Work/Backend/update.php', values)
    console.log("Contraseña actualizada!");
  }
}

function createToken(length) {
  var token = '';
  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var charactersLength = characters.length;

  for (var i=0; i<length; i++) {
     token += characters.charAt(Math.floor(Math.random() * charactersLength));
  }

  return token;
}

function getCurrentDate() {
  var sqlDate = new Date();
  var day = sqlDate.getDate();
  var month = sqlDate.getMonth()+1;
  var year = sqlDate.getFullYear();

  if(day<10) {
    day = "0" + day;
  } 

  if(month<10) {
    month = "0" + month;
  } 

  sqlDate = year+"-"+month+"-"+day + " " +sqlDate.getHours() + ":" + sqlDate.getMinutes()+":" + sqlDate.getSeconds();
  return sqlDate;
}
