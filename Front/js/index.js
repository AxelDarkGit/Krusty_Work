async function loaded() {
  let values = {
    tblName: 'usuario'

  };

  let data = await getRequest('http://localhost/Dist/Krusty_Work/Backend/get.php', values);
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
    console.log("El correo no se envio.");
  }
  else {
    // If the email is found in the database, generate unique token (TODO)
    var token = '222222';

    // Insert request into the database (table reinicio_contra) with emailFound and token
    let sqlInsert = {
      reinicio_correo: emailFound[1],
      reinicio_token: token
    };
    let data = await postRequest('http://localhost/Dist/Krusty_Work/Backend/post.php', sqlInsert)
    
    // Verify query success by checking new entry ID from database (table reinicio_contra)
    var newID;
    if(newID = Object.entries(data).find(pair => pair[0] === 'id' && pair[1] != 0)) {
      console.log(data);
    }
    else {
      console.log("not inserted");
    }
    // TODO

    // Sent email to emailFound with generated unique token (TODO)
    console.log('El correo se ha enviado de manera exitosa.');
    //document.action="e-mail/email.php"
  }
}

async function clickeado() {
  let values = {
    nombre: document.getElementById('nombre').value
  };

  let data = await postRequest('http://localhost/Dist/Krusty_Work/Backend/post.php', values)
  console.log(data);
}