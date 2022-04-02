
function addMaterial(){
    let materials = document.getElementById('insertNewMaterial')
    let mat = materials.getElementsByClassName('numberMaterial');
    let nextNumberMaterial = -1;
    if(mat.length>0){
        for(let i = 0; i < mat.length; i++){
            nextNumberMaterial = Math.max(parseInt(mat[i].id),nextNumberMaterial) + 1;
        }
    }else {
        nextNumberMaterial=0;
    }
    let div = document.createElement('div');
    div.className = 'row material py-2';
    div.id = nextNumberMaterial+'numberMaterial';
    //вставляем id в блок кода, взятый со страницы добавления товара
    div.innerHTML = '<span hidden class="numMaterial">'+nextNumberMaterial+'</span>\n' +
        '                    <div class="col-7 form-floating">\n' +
        '                        <input class=\'form-control\' placeholder="Название материала" id=\'compositions_id\' type="text"\n' +
        '                               name="composition['+nextNumberMaterial+'][0]" list="compositionName">\n' +
        '                        <label for="compositions_id">Выберите материал</label>\n' +
        '                        <datalist id="compositionName">\n' +
        '                            @foreach($composition as $material)\n' +
        '                                <option value="{{$material->id}}">{{$material->name}}</option>\n' +
        '                            @endforeach\n' +
        '                        </datalist>\n' +
        '                    </div>\n' +
        '\n' +
        '                    <div class="col form-floating">\n' +
        '                        <input class="form-control" type="number" min="1" id="compositionNumber" name="composition['+nextNumberMaterial+'][1]">\n' +
        '                        <label for="compositionNumber">Количество</label>\n' +
        '                    </div>\n' +
        '                    <div class="col">\n' +
        '                        <button id="'+nextNumberMaterial+'deleteButton" type="button" class=\'btn btn-sm btn-danger\' onclick="deleteMaterial(this)">\n' +
        '                            <i class="bi bi-x-lg"></i></button>\n' +
        '                    </div>\n' ;

    document.getElementById('insertNewMaterial').appendChild(div);
}

function deleteMaterial(button){

    let num = parseInt(button.id);
    document.getElementById(num+'numberMaterial').remove();
}
