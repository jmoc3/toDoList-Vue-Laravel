<script setup>
  import {ref} from "vue"

  const searchString = ref("")
  const todos = ref(["hacer","cocinar"])

  const addTodo = () => {
    if(searchString.value==""){ 
      return
    }
    todos.value.push(searchString.value.trim())
    searchString.value = ""
  }
  const testing = () => {
    console.log("yo wtf")
  }

  const removeTodo = (index) => {
    todos.value.splice(index,1)
  }
  
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
      <div class="todo" v-for="(todo, index) in todos" :key="index">
        <span >{{ todo[0].toUpperCase() + todo.slice(1) }}</span>
        <v-icon @click.stop="removeTodo(index)" name="co-trash"  />
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
  background-color: #616161;
  width: 100%;
  padding: .5rem 1rem;

  display: flex;
  justify-content: space-between ;
}

.todo:hover{
  color: #616161 ;
  background-color: rgb(201, 201, 198);
  cursor: pointer;
  transition: all .1s ease-in-out ;
}

</style>