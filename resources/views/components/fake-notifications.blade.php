{{-- resources/views/components/fake-notifications.blade.php --}}
<div id="fakeNotifRoot" class="fixed bottom-6 right-6 z-50 flex flex-col gap-3 w-70 sm:w-80 pointer-events-none">
  {{-- Notifications injected here --}}
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const root = document.getElementById("fakeNotifRoot");

  // 10 fake notifications
  const notifs = [
    { name: "Marlon", msg: "Purchased Package ", time: "2 minutes ago" },
    { name: "Kim", msg: "Watched The Webinar", time: "3 minutes ago" },
    { name: "Rico", msg: "Purchased Package", time: "5 minutes ago" },
    { name: "Jenny", msg: "Purchased Package", time: "7 minutes ago" },
    { name: "Mark", msg: "Purchased Package", time: "8 minutes ago" },
    { name: "Liza", msg: "Watched The Webinar", time: "10 minutes ago" },
    { name: "Paolo", msg: "completed checkout", time: "12 minutes ago" },
    { name: "Mia", msg: "Watched The Webinar", time: "15 minutes ago" },
    { name: "Christian", msg: "Purchased Package", time: "18 minutes ago" },
    { name: "Ella", msg: "Purchased Package", time: "20 minutes ago" }
  ];
  let currentIndex = 0;

  function createNotif(data) {
    const initials = data.name
      .split(" ")
      .map(n => n[0])
      .slice(0, 2)
      .join("")
      .toUpperCase();

    const div = document.createElement("div");
    div.className =
      "notif-item bg-white shadow-lg rounded-lg p-3 flex gap-3 items-start border border-slate-100 transform transition-all duration-300 ease-out pointer-events-auto";
    div.innerHTML = `
      <div class="flex-shrink-0">
        <div class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center text-sm font-semibold text-slate-700">
          ${initials}
        </div>
      </div>
      <div class="flex-1">
        <div class="text-sm text-slate-800 leading-snug">
          <span class="font-medium">${data.name}</span>
          <span class="text-slate-600"> ${data.msg}</span>
        </div>
        <div class="text-xs text-slate-400 mt-1">${data.time}</div>
      </div>
    `;

    // start hidden
    div.style.opacity = "0";
    div.style.transform = "translateY(10px) scale(0.98)";

    return div;
  }

  function showNextNotif() {
    const data = notifs[currentIndex];
    currentIndex = (currentIndex + 1) % notifs.length;

    const notif = createNotif(data);
    root.prepend(notif);

    // animate in
    requestAnimationFrame(() => {
      notif.style.opacity = "1";
      notif.style.transform = "translateY(0) scale(1)";
    });

    // stay for 3s then hide
    setTimeout(() => {
      notif.style.opacity = "0";
      notif.style.transform = "translateY(6px) scale(0.98)";
      setTimeout(() => {
        notif.remove();
        // show next notif after hide
        setTimeout(showNextNotif, 3000);
      }, 320);
    }, 3000);
  }

  // start sequence
  showNextNotif();
});
</script>
