//DATA
var options = ['First Name', 'Last Name', 'City', 'Country', 'Street', 'Email'];
var examples = ['Jakub', 'Radzik', 'Wroclaw', 'Poland', 'Spacerowa', 'jakub.radzik@onet.pl'];





function add_line(){

    //FIND LAST LP 
    let numbers = document.querySelectorAll('.lp');
    let ar = [];
    for (let i = 0; i < numbers.length; i++) {
        ar.push(parseInt(numbers[i].innerHTML.trim()));
    }
    let new_lp = Math.max.apply(null, ar);
    new_lp++;
    
    let place = document.querySelector('#liner');
    let new_child = `
    <td class="lp">
    ${new_lp}
    </td>
    <td class="col-name">
    <input type="text">
    </td>
    <td class="type">
    <select name="" id="">
        <option value="Select type">Select type</option>
    </select>
    </td>
    <td class="example">
    </td>`;
    
    let place_code =place.innerHTML + new_child;
    place.innerHTML=place_code;
}