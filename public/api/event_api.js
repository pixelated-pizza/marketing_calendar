axios.defaults.baseURL = '/api';

const EventAPI = {
    getAll() {
        return axios.get('/events');
    },

    getById(id) {
        return axios.get(`/events/${id}`);
    },

    create(data) {
        return axios.post('/events', data);
    },

    update(id, data) {
        return axios.put(`/events/${id}`, data);
    },

    delete(id) {
        return axios.delete(`/events/${id}`);
    }
};


document.addEventListener("DOMContentLoaded", function () {
    EventAPI.getAll().then(res => {
        const tasks = {
            data: res.data.map(event => ({
                id: event.event_id,
                text: event.event_name,
                start_date: event.start_date,
                end_date: event.end_date,
                progress: 1,
                details: (event.campaign_type && event.channel)
                    ? `${event.campaign_type.type_name} - ${event.channel.channel_name}`
                    : "N/A"
            }))
        };

        gantt.config.date_format = "%Y-%m-%d";

        gantt.config.scales = [
            { unit: "month", step: 1, format: "%F %Y" },
            { unit: "week", step: 1, format: "Week %W" },
            { unit: "day", step: 1, format: "%j %D" }
        ];
        gantt.config.scale_height = 60;

        gantt.templates.tooltip_text = function (start, end, task) {
            return `
                <b>${task.text}</b><br/>
                ${task.details}<br/>
                ${gantt.templates.tooltip_date_format(start)} → ${gantt.templates.tooltip_date_format(end)}
            `;
        };

        gantt.init("gantt_here");
        gantt.parse(tasks);

        document.getElementById("add-event").addEventListener("click", () => {
            const id = gantt.uid();
            const today = gantt.getState().min_date || new Date();

            gantt.addTask({
                id: id,
                text: "New Event",
                start_date: today,
                end_date: gantt.date.add(today, 3, "day"),
                progress: 0
            });

            EventAPI.create({
                event_name: "New Event",
                campaign_type_id: 1,
                channel_id: 1,
                start_date: today.toISOString().slice(0, 10),
                end_date: gantt.date.add(today, 3, "day").toISOString().slice(0, 10)
            }).then(res => {
                gantt.changeTaskId(id, res.data.event_id);
            });
        });

        gantt.config.columns = [
            { name: "text", label: "Event", width: 200, tree: true },
            { name: "start_date", label: "Start", align: "center" },
            { name: "end_date", label: "End", align: "center" },
            {
                name: "buttons", label: "Actions", width: 150, align: "center", template: function (task) {
                    return `
                <button class="btn-edit" data-id="${task.id}">✏️</button>
                <button class="btn-delete" data-id="${task.id}">🗑️</button>
            `;
                }
            }
        ];

        document.addEventListener("click", function (e) {
            if (e.target.classList.contains("btn-edit")) {
                const id = e.target.dataset.id;
                const task = gantt.getTask(id);

                const newName = prompt("Edit event name:", task.text);
                if (newName) {
                    task.text = newName;
                    gantt.updateTask(id);
                    EventAPI.update(id, { event_name: newName });
                }
            }

            if (e.target.classList.contains("btn-delete")) {
                const id = e.target.dataset.id;
                if (confirm("Delete this event?")) {
                    gantt.deleteTask(id);
                    EventAPI.delete(id);
                }
            }
        });

        gantt.attachEvent("onAfterTaskAdd", function (id, task) {
            EventAPI.create({
                event_name: task.text,
                start_date: gantt.date.date_to_str("%Y-%m-%d")(task.start_date),
                end_date: gantt.date.date_to_str("%Y-%m-%d")(task.end_date),
                campaign_type_id: 1, 
                channel_id: 1
            }).then(res => {
                gantt.changeTaskId(id, res.data.event_id);
            });
        });

        gantt.attachEvent("onAfterTaskDelete", function (id, task) {
            EventAPI.delete(id);
        });

    });
});


