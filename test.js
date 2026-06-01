async function refresh_temps() {
  const temp_hotend_el = document.getElementById("temp_hotend");
  const temp_bed_el = document.getElementById("temp_bed");

  const temps = await fetch("/api/temp");
  console.log(temps);

  temp_hotend_el.innerText

}


setTimeout(() => { 
await refresh_temps

}, 2000);