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
    axios.put('/api/update/' + data.id, { status: data.status, description: data.description })
      .then(response => {
        // todo - work on updating the local state of the card
        // $vm0.items[1].tasks[0].status = 'done'
        data.card.status = data.status
      })
  },
  deleteTask({ commit }, id) {
    axios.delete('/api/delete/' + id)
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
  }
}

export default {
  state,
  getters,
  actions,
  mutations,
}
