<?php
// session_start();
// $conn = new PDO("mysql:host=localhost;dbname=todo", "root", "");
//     // set the PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// if(isset($_SESSION['user'])){
//   echo  "Bienvenu  ....."  .$_SESSION['user'] ;
// } else {
// header("location: login.php");
// }
 ?>


<html>
  <head>
    <title>Todo App</title>
    <!-- <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" charset="utf-8">    
  </head>
  <body>
   <!-- 
                    <form method="POST">                        
                        <div class="form-group">
                            <input type="submit" name="logout" id="submit" class="form-submit" value="Log out"/>
                        </div>
                    </form> -->


<?php

//     if(isset($_POST['logout'])){
     
//      session_start();
//      session_destroy();
//      header("location: login.php");
// }


?>

   <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <meta name="description" content="Page Description">
        <meta name="author" content="Afolabi mayowa">
        <title>Todo list</title>

        <link href="css/main.css" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		

      
    </head>
    <body>
    <div class="container">
    	<h2 class="text-center">Todo List App</h2>

        	<div class="form-group">
        		<label for="itemInput">Add Item</label>
        		<input type="text" required="test" class="form-control" name="" id="itemInput" >
        	</div>
                <button id="addButton" class="btn btn-primary">Add To List</button>
                <button id="clearButton" class="btn btn-danger">Clear Todo List</button>
        <h3>Todo List</h3>
        <ul id="todoList"></ul>

    </div>

    <script type="text/javascript" src="js/main.js"></script>

  </body>
</html>

<style type="text/css"></style>

<script type="text/javascript">
	



var addButton = document.getElementById('addButton');
var addInput = document.getElementById('itemInput');

var addInputv = document.getElementById('itemInput').value;
	

var todoList = document.getElementById('todoList');
var listArray = [];
//declare addToList function

function listItemObj(content, status) {
    this.content = '';
    this.status = 'incomplete';
}
var changeToComp = function(){
    var parent = this.parentElement;
    console.log('Changed to complete');
    parent.className = 'uncompleted well';
    this.innerText = 'Incomplete';
    this.removeEventListener('click',changeToComp);
    this.addEventListener('click',changeToInComp);
    changeListArray(parent.firstChild.innerText,'complete');

}

var changeToInComp = function(){
    var parent = this.parentElement;
    console.log('Changed to incomplete');
    parent.className = 'completed well';
    this.innerText = 'Complete';
    this.removeEventListener('click',changeToInComp);
    this.addEventListener('click',changeToComp);

    changeListArray(parent.firstChild.innerText,'incomplete');

}

var removeItem = function(){
    var parent = this.parentElement.parentElement;
    parent.removeChild(this.parentElement);

    var data = this.parentElement.firstChild.innerText;
    for(var i=0; i < listArray.length; i++){

        if(listArray[i].content == data){
            listArray.splice(i,1);
            refreshLocal();
            break;
        }
    }


}

//function to change the todo list array
var changeListArray = function(data,status){

    for(var i=0; i < listArray.length; i++){

        if(listArray[i].content == data){
            listArray[i].status = status;
            refreshLocal();
            break;
        }
    }
}

//function to chage the dom of the list of todo list
var createItemDom = function(text,status){

    var listItem = document.createElement('li');

    var itemLabel = document.createElement('label');

    var itemCompBtn = document.createElement('button');

    var itemIncompBtn = document.createElement('button');

    listItem.className = (status == 'incomplete')?'completed well':'uncompleted well';

    itemLabel.innerText = text;
    itemCompBtn.className = 'btn btn-success';
    itemCompBtn.innerText = (status == 'incomplete')?'Complete':'Incomplete';
    if(status == 'incomplete'){
        itemCompBtn.addEventListener('click',changeToComp);
    }else{
        itemCompBtn.addEventListener('click',changeToInComp);
    }


    itemIncompBtn.className = 'btn btn-danger';
    itemIncompBtn.innerText = 'Delete';
    itemIncompBtn.addEventListener('click',removeItem);

    listItem.appendChild(itemLabel);
    listItem.appendChild(itemCompBtn);
    listItem.appendChild(itemIncompBtn);

    return listItem;
}

var refreshLocal = function(){
    var todos = listArray;
    localStorage.removeItem('todoList');
    localStorage.setItem('todoList', JSON.stringify(todos));
}

var addToList = function(){
    var newItem = new listItemObj();
    newItem.content = addInput.value;
    listArray.push(newItem);
    //add to the local storage
    refreshLocal();
    //change the dom
    var item = createItemDom(addInput.value,'incomplete');

    var addInputv = document.getElementById('itemInput').value;

  if (addInputv === '') {
    alert("You must write something!");
  } else {
    todoList.appendChild(item);
    addInput.value = '';
  }


    
}

//function to clear todo list array
var clearList = function(){
    listArray = [];
    localStorage.removeItem('todoList');
    todoList.innerHTML = '';

}

window.onload = function(){
    var list = localStorage.getItem('todoList');

    if (list != null) {
        todos = JSON.parse(list);
        listArray = todos;

        for(var i=0; i<listArray.length;i++){
            var data = listArray[i].content;

            var item = createItemDom(data,listArray[i].status);
            todoList.appendChild(item);
        }

    }

};
//add an event binder to the button


addButton.addEventListener('click',addToList);

clearButton.addEventListener('click',clearList);

</script>
