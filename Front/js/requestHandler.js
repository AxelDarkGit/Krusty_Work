async function getRequest(URL) {
  let response = await fetch(URL);
  return await response.json();
}

async function postRequest(URL, data) {
  let options = {
    method: 'POST',
    headers: {
      'Content-type': 'application/json'
    },
    body: JSON.stringify(data)
  }
  let response = await fetch(URL, options);
  return await response.json();
}

 function myRedirecion() {
    location.href = "C:/xampp/htdocs/Dist/Krusty_Work/Front/psw_recovery/token_page.html";
  }
