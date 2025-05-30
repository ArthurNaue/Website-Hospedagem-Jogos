function openOrCloseNav() 
{
    if(document.getElementById("button").textContent=="ABRIR")
    {
      document.getElementById("mySidebar").style.width = "150px";
      document.getElementById("main").style.marginLeft = "150px";
      document.getElementById("button").textContent = "FECHAR";
    }
    else
    {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
      document.getElementById("button").textContent = "ABRIR";
    }
}
