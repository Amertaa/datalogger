async function fetchRealtimeData() {
  try {
    const response = await fetch('api/getLastdata.php');
    const data = await response.json();

    if (!data.success) return;

    document.getElementById('data-cahaya').innerText = data.cahaya + ' lux';
    document.getElementById('data-tegangan').innerText = data.tegangan_ac + ' V';
    document.getElementById('data-arus').innerText = data.arus_ac + ' A';
    document.getElementById('data-power').innerText = data.power_ac + ' W';
    document.getElementById('data-energy').innerText = data.energy + ' kWh';
    document.getElementById('data-frequency').innerText = data.frequency + ' Hz';
    document.getElementById('data-pf').innerText = data.powerfactor;
    document.getElementById('data-waktu').innerText = data.waktu;
    document.getElementById('data-temp').innerText = data.temperature + ' °C';
    document.getElementById('data-hum').innerText = data.humidity + ' %RH';

    const card = document.getElementById('device-card');
    const status = document.getElementById('status-device');

    if (data.status === 'ONLINE') {
      status.innerText = 'ONLINE';
      card.classList.remove('bg-danger');
      card.classList.add('bg-success');
    } else {
      status.innerText = 'OFFLINE';
      card.classList.remove('bg-success');
      card.classList.add('bg-danger');
    }
  } catch (e) {
    console.error(e);
  }
}

fetchRealtimeData();
setInterval(fetchRealtimeData, 3000);
