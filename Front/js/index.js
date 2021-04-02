async function loaded() {
  let values = {
    tblName: 'usuario'
  };

  let data = await getRequest('http://localhost/Dist/Krusty_Work/Backend/get.php', values);
  console.log(data);
}

async function verifyUser(){
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