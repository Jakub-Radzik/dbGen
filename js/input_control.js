//DATA
var options = ['Id','First Name', 'Last Name', 'City', 'Country', 'Street', 'Email'];
var examples = ['1,2,3...','Jakub', 'Radzik', 'Wroclaw', 'Poland', 'Spacerowa', 'jakub.radzik@onet.pl'];

var option_html='<option value="-1">Select type</option>';

for (let i = 0; i < options.length; i++) {
    option_html+=`<option value="${i}">${options[i]}</option>`;    
}

function generate_options(){
    
    let types = document.querySelectorAll('.type')

    for (let i = 0; i < types.length; i++) {
        types[i].innerHTML=option_html;
    }

}

function generate_example(x){
    
    let active_example='';

    if(x.value==-1){
        active_example='';
    }else{
        active_example=examples[x.value];
    }
    
    x.parentNode.parentNode.querySelector('.example').innerHTML=active_example;

}

function numering(){
    //FIND LAST LP 
    let lp = document.querySelectorAll('.lp');
    
    for (let i = 0; i < lp.length; i++) {
        lp[i].innerHTML=i+1; 
        lp[i].parentElement.querySelector('.col-name').querySelector('*').name=`col-name-${i+1}`;
        lp[i].parentElement.querySelector('.td-type').querySelector('*').name=`data-type-${i+1}`;
        lp[i].parentElement.querySelector('.type-of-data-div').querySelector('*').name=`type-of-data-${i+1}`;
    }
}

function add_line(){

    let child_line = document.createElement('div');
    child_line.classList.add('define-position');



    child_line.innerHTML=`
    
    <div class="dismiss" onclick="delete_line(this)">X</div>
    <div class="lp"></div>
    <div class="col-name"><input type="text"  name="col-name-1"></div>


    <div class="div-type">
        <select class='type' name="data-type" onchange="generate_example(this)">
            ${option_html}
        </select>
    </div>
    

    <div class="example">Example</div>

    <div class="type-of-data-div"><input type="text" name="type-of-data-1"></div>
`;
    
    document.querySelector('.sql-data').appendChild(child_line);
    numering();
}

function delete_line(x){
    x.parentNode.parentNode.remove();
    numering();
}