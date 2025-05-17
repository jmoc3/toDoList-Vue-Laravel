<script setup>
  import {onMounted, ref} from "vue"

  const searchString = ref("")
  const todos = ref([])
  const loadingId = ref(null)

  const addTodo = () => {
    if(searchString.value==""){ return }
    
    const todoCapitalized = (searchString.value[0].toUpperCase() + searchString.value.slice(1)).trim()
    searchString.value = ""
    
    const content = {
      "descripcion":todoCapitalized,
      "user_id":1
    }

    fetch(`http://localhost:8000/api/todos/`,{
      method:"POST",
      headers:{
        "Content-type":"application/json"
      },
      body:JSON.stringify(content)

    }).then(res=>res.json()).then(response => {
      if(response.error) throw new Error("Minimo no digitado")
      todos.value.push(response)
    }).catch(error => console.log(error.message))
  }

  const removeTodo = (index) => {
    loadingId.value = index
    fetch(`http://localhost:8000/api/todos/${index}`,{
      method:"DELETE"
    }).then(res=>res.json()).then(response => {
      todos.value = todos.value.filter(record => record.id!=index)
      loadingId.value=null
      console.log(response.message)
    })
  }
  
  onMounted(()=>{
    fetch("http://localhost:8000/api/todos").then(res => res.json()).then(response =>{
      console.log(response)
      todos.value = response
    })
  })
</script>

<template>
  <div class="main">
    <form @submit.prevent="addTodo" class="topSection"> 
      <h1>ToDo List</h1>
      <div class="inputFather">
        <input v-model="searchString" type="text">
        <button type="submit">+</button>
      </div>
    </form>
    <div class="todosList" >
      <div v-if="todos.length>0" class="todo" v-for="(todo, index) in todos" :key="index">
        <span >{{ todo.descripcion }}</span>
        <v-icon v-if="loadingId!=todo.id" @click.stop.once="removeTodo(todo.id)" name="co-trash"  />
        <v-icon v-else name="co-reload"  />
      </div>
    </div>
  </div>
</template>

<style>

.main{
  width: fit-content;
  display: flex;
  flex-direction: column;
  gap: 2rem;

  align-items: center;
  justify-self: center;
}

.inputFather{
  display: flex;
  gap: 10px;
}

input{
  padding: .2rem;
  border-radius: 2px;
}

input:focus{
  outline: none;
}

.inputFather button{
  padding: 0 10px;
  cursor: pointer;
}

.todosList{
  width: 100%;
  display: grid;
  border-radius: .5rem;
  overflow: hidden;
}

.todo{
  background-color: #383838;
  width: 100%;
  padding: .5rem 1rem;

  display: flex;
  justify-content: space-between ;
}

.todo:hover{
  color: #313131 ;
  background-color: rgb(201, 201, 198);
  cursor: pointer;
  transition: all .1s ease-in-out ;
}

</style>