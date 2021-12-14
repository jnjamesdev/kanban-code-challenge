<template>
  <div>
    <div v-if="items">
      <draggable class="kanban-board" group="groups" v-model="items" @change="test()">
        <kanban-column v-for="(group, groupId) in items" :key="'group_' + groupId" :label="group.label || 'Untitled'" @create="createTask($event)">
          <draggable class="kanban-board__drop-area" group="{name: 'tasks_' + groupId, put: true}" v-model="items[groupId].tasks"  @change="updateStatus($event, groupId)">
            <kanban-item v-for="(card, cardId) in group.tasks" :key="'card_' + card.order" v-model="card.description" @change="changeDescription($event, card)" @delete="deleteTask(card.id)" />
          </draggable>
        </kanban-column>
      </draggable>
    </div>
  </div>
</template>

<script>
// Components
import KanbanColumn from './KanbanColumn'
import KanbanItem from './KanbanItem'

import draggable from 'vuedraggable'

export default {
  order: 1,
  components: {
    KanbanColumn,
    KanbanItem,
    draggable,
  },
  mounted() {
    this.$store.dispatch('getTasks', null, {root:true})
  },
  computed: {
    items() {
      let todoTasks = this.$store.state.kanban.tasks.filter(task => task.status === 'todo');
      todoTasks = todoTasks.sort((a, b) => a.order > b.order ? 1 : -1);
      let inProgTasks = this.$store.state.kanban.tasks.filter(task => task.status === 'in progress');
      inProgTasks = inProgTasks.sort((a, b) => a.order > b.order ? 1 : -1);

      let doneTasks = this.$store.state.kanban.tasks.filter(task => task.status === 'done');
      doneTasks = doneTasks.sort((a, b) => a.order > b.order ? 1 : -1);


      return [{label: 'Todo', tasks: todoTasks}, {label: 'In Progress', tasks: inProgTasks}, {label: 'Done', tasks: doneTasks}]
    }
  },
  data() {

    return {
      showCreateSection: false,
    }
  },
  methods: {
    test() {
      debugger;
    },
    createTask(data) {
      data.order = 1;
      this.$store.dispatch('createTask' , data)

    },
    deleteTask(id) {
      this.$store.dispatch('deleteTask' , id)
    },
    updateStatus(evnt, groupId) {
      let newIndex;
      let oldIndex;
      let taskId
      let status = '';
      if (event.removed) {
        oldIndex = evnt.removed.oldIndex;

      }

      if (evnt.moved) {
        taskId = evnt.moved.element.id
        newIndex = evnt.moved.newIndex;
        oldIndex = evnt.moved.oldIndex;
        this.$store.dispatch('updateTask', {status: status, id: taskId, card: evnt.moved.element, newIndex: newIndex, oldIndex: oldIndex}, {root:true})
      }
      if (evnt.added) {
        taskId = evnt.added.element.id
        newIndex = evnt.added.newIndex;


        switch(groupId) {
          case 0:
            status = 'todo';
            break;
          case 1:
            status = 'in progress';
            break;
          case 2:
            status = 'done'
            break
        }
        this.$store.dispatch('updateTask', {status: status, id: taskId, card: evnt.added.element, index: newIndex, oldIndex: oldIndex}, {root:true})
      }
    },
    changeDescription(event, card) {
      this.$store.dispatch('updateTask', {description: event, id: card.id}, {root:true})
    }
  }
}
</script>

<style lang="scss" scoped>
.kanban-board {
  width: 1200px;
  display: flex;
  gap: 15px;

  font-family: 'Nunito', sans-serif;
  color: #8A94A5;
}

.kanban-board__drop-area {
  flex: 1;
  min-height: 400px;
}
</style>
