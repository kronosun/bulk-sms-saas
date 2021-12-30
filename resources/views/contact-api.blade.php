<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Contact Picker API Demo</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/style.css">
    <meta name="theme-color" content="#3f51b5">
    <!-- OT Expires 2020-01-14 -->
    <meta http-equiv="origin-trial" content="AkAQoYg8XDMUqBR/HwcOUoqAx3Z5+RyarNB5KwUx9ZXygz7wjd8cxqKvwY3FOO1CPdqccip8g8Ayuf9/pqTxmwUAAABheyJvcmlnaW4iOiJodHRwczovL2NvbnRhY3QtcGlja2VyLmdsaXRjaC5tZTo0NDMiLCJmZWF0dXJlIjoiQ29udGFjdHNNYW5hZ2VyIiwiZXhwaXJ5IjoxNTc5MDI5NTcwfQ==">

    <script>
    	/**
		 * Warn the page must be served over HTTPS
		 * The `beforeinstallprompt` event won't fire if the page is served over HTTP.
		 * Installability requires a service worker with a fetch event handler, and
		 * if the page isn't served over HTTPS, the service worker won't load.
		 */
		if (window.location.protocol === 'http:') {
		  const requireHTTPS = document.getElementById('requireHTTPS');
		  const link = requireHTTPS.querySelector('a');
		  link.href = window.location.href.replace('http://', 'https://');
		  requireHTTPS.classList.remove('hidden');
		  window.location.href = 'https:' + window.location.href.substring(5);
		}
	</script>
	<script>
		const butReq = document.getElementById('butRequest');
		butReq.addEventListener('click', getContacts);

		const cbMultiple = document.getElementById('multiple');
		const cbName = document.getElementById('name');
		const cbEmail = document.getElementById('email');
		const cbTel = document.getElementById('tel');
		const cbAddress = document.getElementById('address');
		const cbIcon = document.getElementById('icon');
		const ulResults = document.getElementById('results');
		const preResults = document.getElementById('rawResults');

		const supported = ('contacts' in navigator && 'ContactsManager' in window);

		if (supported) {
		  const divNotSupported = document.getElementById('notSupported');
		  divNotSupported.classList.toggle('hidden', true);
		  butReq.removeAttribute('disabled');
		  checkProperties();
		}

		async function checkProperties() {
		  const supportedProperties = await navigator.contacts.getProperties();
		  if (supportedProperties.includes('name')) {
		    enableProp(cbName);
		  }
		  if (supportedProperties.includes('email')) {
		    enableProp(cbEmail);
		  }
		  if (supportedProperties.includes('tel')) {
		    enableProp(cbTel);
		  }
		  if (supportedProperties.includes('address')) {
		    enableProp(cbAddress);
		  }
		  if (supportedProperties.includes('icon')) {
		    enableProp(cbIcon);
		  }
		}

		async function getContacts() {
		  const props = [];
		  if (cbName.checked) props.push('name');
		  if (cbEmail.checked) props.push('email');
		  if (cbTel.checked) props.push('tel');
		  if (cbAddress.checked) props.push('address');
		  if (cbIcon.checked) props.push('icon');
		  
		  const opts = {multiple: cbMultiple.checked};
		  
		  try {
		    const contacts = await navigator.contacts.select(props, opts);
		    handleResults(contacts);
		  } catch (ex) {
		    ulResults.classList.toggle('error', true);
		    ulResults.classList.toggle('success', false);
		    ulResults.innerText = ex.toString();
		  }

		}

		function handleResults(contacts) {
		  ulResults.classList.toggle('success', true);
		  ulResults.classList.toggle('error', false);
		  ulResults.innerHTML = '';
		  renderResults(contacts);
		}

		function enableProp(cbox) {
		  cbox.removeAttribute('disabled');
		  cbox.setAttribute('checked', 'checked');
		}

		function renderResults(contacts) {
		  contacts.forEach((contact) => {
		    const lines = [];
		    if (contact.name) lines.push(`<b>Name:</b> ${contact.name.join(', ')}`);
		    if (contact.email) lines.push(`<b>E-mail:</b> ${contact.email.join(', ')}`);
		    if (contact.tel) lines.push(`<b>Telephone:</b> ${contact.tel.join(', ')}`);
		    if (contact.address) {
		      contact.address.forEach((address) => {
		        lines.push(`<b>Address:</b> ${JSON.stringify(address)}`);
		      });
		    }
		    if (contact.icon) {
		      contact.icon.forEach((icon) => {
		        const imgURL = URL.createObjectURL(icon);
		        lines.push(`<b>Icon:</b> <img src="${imgURL}">`);
		      });      
		    }
		    lines.push(`<b>Raw:</b> <code>${JSON.stringify(contact)}</code>`);
		    const li = document.createElement('li');
		    li.innerHTML = lines.join('<br>');
		    ulResults.appendChild(li);
		  });
		  const strContacts = JSON.stringify(contacts, null, 2);
		  console.log(strContacts);
		}

	</script>

	<style>
		body {
		  font-family: Helvetica, Arial, sans-serif;
		}

		h1 {
		  text-align: center;
		  position: sticky;
		  top: 0;
		  background-color: white;
		}

		p { clear: both; }

		.hidden {
		  display: none !important;
		}

		#notSupported b:first-of-type,
		#requireHTTPS b:first-of-type {
		  color: #b71c1c;
		}

		button[disabled] {
		  opacity: 0.5;
		  border: 1px solid rgba(74, 20, 140, 0.5) !important;
		}

		button {
		  background-color: #e8eaf6;
		  border: 1px solid #3f51b5;
		  font-size: 1em;
		  padding: 0.75em;
		}

		label {
		  display: inline-block;
		  width: 300px;
		}

		ol {
		  list-style-type: none;
		  padding-inline-start: 0;
		}

		ul {
		  color: #aaa;
		}

		ul.success {
		  color: #000;
		}

		ul.error {
		  color: red;
		}
	</style>
  </head>  
  <body>
    <h1>
      Contact Picker API Demo
    </h1>
    
    <p id="requireHTTPS" class="hidden">
      <b>STOP!</b> This page <b>must</b> be served over HTTPS.
      Please <a>reload this page via HTTPS</a>.
    </p>
       
    <p id="notSupported">
      <b>Sorry!</b> This browser doesn't support the Contact
      Picker API, which required for this demo. Try enabling the
      <code>#enable-experimental-web-platform-features</code> in
      chrome://flags and try again.
    </p>
       
    <p>
      Access to the user’s contacts has been a feature of native apps since (almost) 
      the dawn of time. The <b>Contact Picker API</b> is a new, on-demand picker 
      that allows users to select an entry or entries from their contact list 
      and share limited details of the selected contact(s) with a website. 
      It allows users to share only what they want, when they want, and makes 
      it easier for users to reach and connect with their friends and family.
    </p>

    <p>
      <b>Note:</b> This demo requires Chrome 80 or later 
      running on Android M or later to work properly.
    </p>

    <ol>
      <li>
        <input type="checkbox" id="multiple" />
        <label for="multiple">Multiple results?</label>
      </li>
      <li>
        <input type="checkbox" id="name" disabled />
        <label for="name">Include name?</label>
      </li>
      <li>
        <input type="checkbox" id="email" disabled />
        <label for="email">Include email addresses?</label>
      </li>
      <li>
        <input type="checkbox" id="tel" disabled />
        <label for="tel">Include telephone numbers?</label>
      </li>
      <li>
        <input type="checkbox" id="address" disabled />
        <label for="address">Include addresses? (Chrome 84 and later)</label>
      </li>
      <li>
        <input type="checkbox" id="icon" disabled />
        <label for="icons">Include icons? (Chrome 84 and later)</label>
      </li>
    </ol>

    <p>
      This demo <b>does not</b>
      share or upload your contacts. It simply shows them on screen, and no
      contact data is transferred off this device.
    </p>
    
    <p>
      <button id="butRequest" type="button" disabled>
        Open contact picker
      </button>
    </p>
    
    <p>
      <b>Results</b>
    </p>
    <ul id="results">
      <li>Results will be populated here.</li>
    </ul>
    <pre id="rawResults">
    </pre>
    
    <p>
      See <a href="https://developers.google.com/web/updates/2019/08/contact-picker" target="_blank">A Contact Picker for the Web</a>
      for complete details on the API, including use cases, how it was designed, and how to use it.
    </p>
    
    <p>
      Check out the 
      <a href="https://glitch.com/edit/#!/contact-picker">source</a>
      for this sample, or
      <a href="https://glitch.com/edit/#!/remix/contact-picker">remix it</a> on Glitch.
    </p>
    
    
    {{-- <script src="/common.js"></script>
    <script src="/demo.js"></script> --}}

  </body>
</html>
