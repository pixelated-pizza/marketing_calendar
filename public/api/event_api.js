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
    },
    getCampaignTypes() {
        return axios.get('/campaign-types');
    },
    getChannels() {
        return axios.get('/channels');
    }
};


document.addEventListener("DOMContentLoaded", function () {
    Promise.all([EventAPI.getCampaignTypes(), EventAPI.getChannels()]).then(([typesRes, channelsRes]) => {
        const campaignTypes = typesRes.data;
        const channels = channelsRes.data;

        gantt.serverList("campaign_types", campaignTypes.map(ct => ({
            key: ct.campaign_type_id,
            label: ct.type_name
        })));

        gantt.serverList("channels", channels.map(ch => ({
            key: ch.channel_id,
            label: ch.channel_name,
            campaign_type_id: ch.campaign_type_id
        })));

        gantt.config.lightbox.sections = [
            { name: "description", height: 40, map_to: "text", type: "textarea", focus: true },
            {
                name: "campaign_type", height: 30, map_to: "campaign_type_id",
                type: "select", options: gantt.serverList("campaign_types")
            },
            {
                name: "channel", height: 30, map_to: "channel_id",
                type: "select", options: [] 
            },
            { name: "time", height: 72, type: "duration", map_to: "auto" }
        ];

        gantt.attachEvent("onLightboxFieldChange", function (fieldName, newValue, oldValue) {
            if (fieldName === "campaign_type") {
                const channelSection = gantt.getLightboxSection("channel");
                const availableChannels = gantt.serverList("channels").filter(ch => ch.campaign_type_id == newValue);
                channelSection.control.options = availableChannels;
                channelSection.control.selectedIndex = 0;
            }
        });

        EventAPI.getAll().then(res => {
            gantt.config.date_format = "%Y-%m-%d";

            gantt.config.scales = [
                { unit: "month", step: 1, format: "%F %Y" },
                { unit: "week", step: 1, format: "Week %W" },
                { unit: "day", step: 1, format: "%j %D" }
            ];
            gantt.config.scale_height = 60;

            gantt.config.columns = [
                { name: "text", label: "Campaign Name", width: 200, tree: true },
                {
                    name: "buttons", label: "Actions", width: 150, align: "center", template: function (task) {
                        return `
                            <button class="btn-edit" data-id="${task.id}">✏️</button>
                            <button class="btn-delete" data-id="${task.id}">🗑️</button>
                        `;
                    }
                }
            ];

            gantt.templates.tooltip_text = function (start, end, task) {
                return `
                    <b>${task.text}</b><br/>
                    ${task.details}<br/>
                    ${gantt.templates.tooltip_date_format(start)} → ${gantt.templates.tooltip_date_format(end)}
                `;
            };

            gantt.skin = "material";
            gantt.init("gantt_here");

            gantt.parse({
                data: res.data.map(event => ({
                    id: event.event_id,
                    text: event.event_name,
                    start_date: event.start_date,
                    end_date: event.end_date,
                    progress: 1,
                    campaign_type_id: event.campaign_type_id,
                    channel_id: event.channel_id,
                    details: (event.campaign_type && event.channel)
                        ? `${event.campaign_type.type_name} - ${event.channel.channel_name}`
                        : "N/A"
                }))
            });
        });

        gantt.attachEvent("onLightboxSave", function (id, task, is_new) {
            const payload = {
                event_name: task.text,
                start_date: gantt.date.date_to_str("%Y-%m-%d")(task.start_date),
                end_date: gantt.date.date_to_str("%Y-%m-%d")(task.end_date),
                campaign_type_id: task.campaign_type_id,
                channel_id: task.channel_id
            };

            if (is_new) {
                EventAPI.create(payload).then(res => {
                    gantt.changeTaskId(id, res.data.event_id);
                });
            } else {
                EventAPI.update(id, payload);
            }
            return true;
        });

        gantt.attachEvent("onAfterTaskDelete", function (id, task) {
            EventAPI.delete(id);
        });
    });
});
