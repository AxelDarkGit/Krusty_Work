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

async function verifyUser(){
  // Declare table name to request all entries from.
  let values = {
    tblName: 'usuario'
  };
  // Get all entries from tblName
  let data = await postRequest('http://localhost/Dist/Krusty_Work/Backend/get.php', values);

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

function createToken(length) {
  var token = '';
  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var charactersLength = characters.length;
  for (var i=0; i<length; i++) {
     token += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return token;
}
