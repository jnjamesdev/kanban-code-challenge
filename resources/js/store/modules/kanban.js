import axios from 'axios';


/**
 * Storage.
 */
const state = {
  tasks: [],
}

/**
 * Retrieve data from storage.
 */
const getters = {

}

/**
 * Go and get data, do other data related stuff.
 */
const actions = {
  getTasks({ commit }) {
    axios.get('/api/index')
      .then(response => {
        commit('SET_TASKS', response.data)
      })
  },
  updateTask({ commit }, data) {
    if (data.status) {
      commit('UPDATE_TASK', data)
    }
    if (data.newIndex !== undefined) {
      commit('UPDATE_TASK_INDEX', data)
    }

    axios.put('/api/update/' + data.id, { status: data.status, description: data.description, order: data.newIndex })
      .then(response => {
      })
  },
  deleteTask({ commit }, id) {
    axios.delete('/api/delete/' + id)
      .then(response => {
        location.reload();
      })
  },
  createTask({ commit }, data) {
    axios.post('/api/store/', data)
      .then(response => {
        location.reload();
      })
  }
}

/**
 * Modify the data in storage.
 */
const mutations = {
  SET_TASKS(state, tasks) {
    state.tasks = tasks
  },
  UPDATE_TASK(state, data) {
    data.card.status = data.status
  },
  UPDATE_TASK_INDEX(state, data) {

    data.card.order = data.newIndex;

    state.tasks = state.tasks.map(
      (task) => {
        if (task.order > data.newIndex) {
          task.order = task.order + 1;
        }
        return task;
      }

    )


  },
}

export default {
  state,
  getters,
  actions,
  mutations,
}
