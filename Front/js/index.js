async function loaded() {
  let data = await getRequest('http://localhost/Dist/Backend/get.php');
  console.log(data);
}

async function clickeado() {
  let values = {
    nombre: document.getElementById('nombre').value
  };

  let data = await postRequest('http://localhost/Dist/Backend/post.php', values)
  console.log(data);
}