function openOrCloseNav() 
{
    if(document.getElementById("button").textContent=="OPEN")
    {
      document.getElementById("mySidebar").style.width = "150px";
      document.getElementById("main").style.marginLeft = "150px";
      document.getElementById("button").textContent = "CLOSE";
    }
    else
    {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
      document.getElementById("button").textContent = "OPEN";
    }
}
