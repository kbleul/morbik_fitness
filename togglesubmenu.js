
const expandSubmemnu = (e) => {
    const element_id = e.target.id;
    console.log(element_id);
   $(document.getElementsByClassName("collapse")[element_id]).toggle();
}

let submenu_container = document.getElementsByClassName("submenu_conatiner");

for(let i = 0; i < submenu_container.length; i++)
{
    submenu_container[i].addEventListener("click", (e) => { expandSubmemnu(e)} )
}
