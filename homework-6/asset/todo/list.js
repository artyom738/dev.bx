import {Item} from "./item.js";

export class List
{
	isProgress;
	loading;
	itemListContainer;
	container;
	items;
	temp;

	constructor({container})
	{
		this.container = container;
		this.items = [];

		this.itemListContainer = document.createElement('div');
		this.itemListContainer.classList.add('calendar-items');

		this.loading = document.createElement('div');
		this.loading.classList.add('hidden');
		this.loading.innerText = 'Loading...';

		this.container.append(this.loading);

		this.container.append(this.itemListContainer);

		this.isProgress = false;
	}

	render()
	{
		this.load().then(({items}) => {
			if (Array.isArray(items))
			{
				items.forEach((itemData) => {
					this.items.push(this.createItem(itemData));
				});
			}

			this.renderItems();
		}).catch((result) => {
			console.error('Error trying to load items: ' + result);
		});

		this.container.append(this.renderActions());
	}

	createItem(itemData)
	{
		itemData.deleteButtonHandler = this.handleDeleteButtonClick.bind(this);
		itemData.editButtonHandler = this.handleEditButtonClick.bind(this);
		return new Item(itemData);
	}

	handleDeleteButtonClick(item)
	{
		const index = this.items.indexOf(item);
		if (index > -1)
		{
			this.items.splice(index, 1);
			this.save().then(() => {
				this.renderItems();
			}).catch((error) => {
				console.error('Error trying to delete item');
			})
		}
	}

	renderItems()
	{
		this.itemListContainer.innerHTML = '';

		this.items.forEach((item) => {
			this.itemListContainer.append(item.render());
		});
	}

	renderActions()
	{
		const actionsContainer = document.createElement('div');
		const addContainer = document.createElement('div');
		const addInput = document.createElement('input');
		addInput.classList.add('calendar-new-item-title');
		const addButton = document.createElement('button');
		addButton.setAttribute('id', 'add');
		addButton.innerText = 'Add';
		addButton.addEventListener('click', this.handleAddButtonClick.bind(this));

		const saveButton = document.createElement('button');
		saveButton.setAttribute('id', 'save');
		saveButton.innerText = 'Save';
		saveButton.classList.add('hidden');
		saveButton.addEventListener('click', this.handleSaveEditedButtonClick.bind(this));

		addContainer.append(addInput);
		addContainer.append(addButton);
		addContainer.append(saveButton);
		actionsContainer.append(addContainer);

		return actionsContainer;
	}

	handleEditButtonClick(item)
	{
		this.loading.innerText = 'Editing item';
		this.loading.classList.remove('hidden');
		const inputField = document.getElementsByClassName('calendar-new-item-title')[0];
		inputField.value = item.title;
		const addButton = document.getElementById('add');
		addButton.classList.add('hidden');
		const editButton = document.getElementById('save');
		editButton.classList.remove('hidden');
		this.temp = item;
	}

	handleSaveEditedButtonClick(item)
	{
		item = this.temp;
		const inputField = document.getElementsByClassName('calendar-new-item-title')[0];
		const index = this.items.indexOf(item);
		if (index > -1 && inputField.value !== this.items[index].title)
		{
			item['title'] = inputField.value;
			// this.handleDeleteButtonClick(item);
			this.items.splice(index, 1, item);

			this.save().then(() => {
				this.renderItems();
			}).catch((error) => {
				console.error('Error trying to save item');
			})
			inputField.value = '';

			const addButton = document.getElementById('add');
			addButton.classList.remove('hidden');
			const editButton = document.getElementById('save');
			editButton.classList.add('hidden');
			this.loading.innerText = 'Loading...';
		}
	}

	handleAddButtonClick()
	{
		const addInput = this.container.querySelector('[class="calendar-new-item-title"]');
		if (addInput)
		{
			if (addInput.value.length === 0)
			{
				return;
			}
			this.items.push(this.createItem({title: addInput.value}));
			addInput.value = '';

			this.save().then(() => {
				this.renderItems();
			}).catch((error) => {
				console.error('Error trying save items: ' + error);
			});
		}
	}

	load()
	{
		return new Promise((resolve, reject) => {
			if (this.isProgress)
			{
				reject('Another action in progress');
				return;
			}
			this.startProgress();
			return fetch(
				'./ajax.php?action=load',
				{
					method: "POST",
				}
			).then((response) => {
				return response.json();
			}).then((result) => {
				if (result.error)
				{
					reject(result.error);
					return;
				}

				resolve(result);
			}).catch((result) => {
				reject(result);
			}).finally(() => {
				this.stopProgress()
			});
		});
	}

	save()
	{
		return new Promise((resolve, reject) => {
			if (this.isProgress)
			{
				reject('Another action in progress');
				return;
			}
			this.startProgress();
			const data = {
				items: []
			};
			this.items.forEach((item) => {
				data.items.push(item.getData());
			});

			return fetch(
				'./ajax.php?action=save',
				{
					method: "POST",
					headers: {
						'Content-Type': 'application/json;charset=utf-8'
					},
					body: JSON.stringify(data)
				}
			).then((response) => {
				return response.json();
			}).then((result) => {
				if (result.error)
				{
					reject(result.error);
					return;
				}

				resolve(result);
			}).catch((result) => {
				reject(result);
			}).finally(() => {
				this.stopProgress()
			});
		});
	}

	startProgress()
	{
		this.loading.classList.remove('hidden');
		this.isProgress = true;
	}

	stopProgress()
	{
		this.loading.classList.add('hidden');
		this.isProgress = false;
	}
}