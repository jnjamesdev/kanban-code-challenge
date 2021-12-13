<template>
  <div>
    <div v-if="items">
      <draggable class="kanban-board" group="groups" v-model="items">
        <kanban-column v-for="(group, groupId) in items" :key="'group_' + groupId" :label="group.label || 'Untitled'" @create="createTask()">
          <draggable class="kanban-board__drop-area" group="{name: 'tasks_' + groupId, put: true}" v-model="items[groupId].tasks"  @change="updateStatus($event, groupId)">
            <kanban-item v-for="(card, cardId) in group.tasks" :key="'card_' + cardId" v-model="card.description" @change="changeDescription($event, card)" @delete="deleteTask(card.id)" />
          </draggable>
        </kanban-column>
      </draggable>
    </div>
    <kanban-create></kanban-create>
  </div>
</template>

<script>
// Components
import KanbanColumn from './KanbanColumn'
import KanbanItem from './KanbanItem'
import KanbanCreate from './KanbanCreate'

import draggable from 'vuedraggable'

export default {
  components: {
    KanbanColumn,
    KanbanItem,
    draggable,
    KanbanCreate,
  },
  mounted() {
    this.$store.dispatch('getTasks', null, {root:true})
  },
  computed: {
    items() {
      const todoTasks = this.$store.state.kanban.tasks.filter(task => task.status === 'todo');
      const inProgTasks = this.$store.state.kanban.tasks.filter(task => task.status === 'in progress');
      const doneTasks = this.$store.state.kanban.tasks.filter(task => task.status === 'done');

      return [{label: 'Todo', tasks: todoTasks}, {label: 'In Progress', tasks: inProgTasks}, {label: 'Done', tasks: doneTasks}]
    }
  },
  data() {

    return {
      showCreateSection: false,
    }
  },
  methods: {
    createTask() {
    },
    deleteTask(id) {
      this.$store.dispatch('deleteTask' , id)
    },
    updateStatus(evnt, groupId) {
      if (evnt.added) {
        const taskId = evnt.added.element.id
        let status = '';
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
        this.$store.dispatch('updateTask', {status: status, id: taskId}, {root:true})
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
