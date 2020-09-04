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
    }
}

function add_line(){

    let child_line = document.createElement('tr');
    child_line.innerHTML=`
    <td><input type="button" value="X" onclick="delete_line(this)"></td>
    <td class="lp">
    </td>
    <td class="col-name">
    <input type="text"  name="col-name">
    </td>
    <td class="td-type">
    <select class='type' name="data-type" onchange="generate_example(this)">
    ${option_html}
    </select>
    </td>
    <td class="example">
    </td>`;
    
    document.querySelector('#liner').appendChild(child_line);
    numering();
}

function delete_line(x){
    x.parentNode.parentNode.remove();
    numering();
}