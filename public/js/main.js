menuItem = document.getElementsByClassName("menu-item");

function toogleContent(identifiant){
    itemContent = document.getElementById(identifiant).parentElement.getElementsByClassName("menu-content")[0];
    id_ = document.getElementById(identifiant).parentElement.id;

    hideElement(menuItem, id_);

    itemContent.classList.toggle("hide-item");
}

function hideElement(menu, id){
    for (let index = 0; index < menu.length; index++) {
        item_id = menu[index].parentElement.id;
        item = menu[index].parentElement.getElementsByClassName("menu-content")[0];
        if (item_id != id) {
            item.classList.add("hide-item");
        }
    }
}