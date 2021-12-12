<template>
  <div v-if="items">
    <draggable class="kanban-board" group="groups" v-model="items" @end="() => {}">
      <kanban-column v-for="(group, groupId) in items" :key="'group_' + groupId" :label="group.label || 'Untitled'" @create="() => {}">
        <draggable class="kanban-board__drop-area" group="{name: 'tasks_' + groupId, put: true}" v-model="items[groupId].tasks" @end="() => {}">
          <kanban-item v-for="(card, cardId) in group.tasks" :key="'card_' + cardId" v-model="card.content" @change="() => {}" @delete="() => {}" />
        </draggable>
      </kanban-column>
    </draggable>
  </div>
</template>

<script>
// Components
import KanbanColumn from './KanbanColumn'
import KanbanItem from './KanbanItem'
import draggable from 'vuedraggable'

export default {
  components: {
    KanbanColumn,
    KanbanItem,
    draggable,
  },

  data() {
    return {
      // Example structure
      items: [
        {
          label: 'Todo',
          tasks: [
            {
              content: 'hello world',
            },
          ],
        },
        {
          label: 'In Progress',
          tasks: [
            {
              content: 'what',
            },
          ],
        },
        {
          label: 'Done',
          tasks: [
            {
              content: 'what',
            },
          ],
        },
      ],
    }
  },
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
