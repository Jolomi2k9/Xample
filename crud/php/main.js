
/* Make the id read-only */
let id = $("input[name*='game_id']")
id.attr("readonly","readonly");




/* listen for edit button click */
$(".btnedit").click( e =>{    
    let textvalues = retrieveData(e);
    /* get reference to textboxes */
    
    let gametitle = $("input[name*='game_title']");
    let gamedeveloper = $("input[name*='game_developer']");
    let gamepublisher = $("input[name*='game_publisher']");
    let gameplatform = $("input[name*='game_platform']");
    let gameprice = $("input[name*='game_price']");

    /* Display returned data in textbox */
    id.val(textvalues[0]);
    gametitle.val(textvalues[1]);
    gamedeveloper.val(textvalues[2]);
    gamepublisher.val(textvalues[3]);
    gameplatform.val(textvalues[4]);
    gameprice.val(textvalues[5].replace("€",""));
})

/*  */
function retrieveData(e){
    let id= 0;
    const td = $("tbody tr td");
    let textvalues = [];
    for(const value of td){
        /* return data of clicked edit button based on it's id */
        if(value.dataset.id == e.target.dataset.id){
            textvalues[id++] = value.textContent;
        }        
    }
    return textvalues;
    /* console.log(td); */
}