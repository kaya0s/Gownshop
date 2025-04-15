const tableData = {
    pending: [
      { name: 'Mark', address: 'Otto', contact: '@mdo', item: 'Gown A', price: '₱1000', release: '2024-04-01', return: '2024-04-05', status: 'Pending' },
      { name: 'Anna', address: 'Dela Cruz', contact: '@anna', item: 'Dress B', price: '₱1500', release: '2024-04-02', return: '2024-04-06', status: 'Pending' },
    ],
    booked: [
      { name: 'Jhon', address: 'Smith', contact: '@jsmith', item: 'Suit X', price: '₱2000', release: '2024-04-03', return: '2024-04-07', status: 'Booked' },
    ],
    unreturned: [
      { name: 'Ella', address: 'Baylon', contact: '@ella', item: 'Gown C', price: '₱1800', release: '2024-03-30', return: '---', status: 'Unreturned' },
    ],
  };
  
  function loadTable(status) {
    const tbody = document.getElementById('table-body');
    tbody.innerHTML = ''; // Clear table
  
    const data = tableData[status] || [];
    data.forEach((row, index) => {
      tbody.innerHTML += `
        <tr>
          <td>${index + 1}</td>
          <td>${row.name}</td>
          <td>${row.address}</td>
          <td>${row.contact}</td>
          <td>${row.item}</td>
          <td>${row.price}</td>
          <td>${row.release}</td>
          <td>${row.return}</td>
          <td>${row.status}</td>
        </tr>
      `;
    });
  
    // Optional: update button styling to show active
    document.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
  }
  
  // Load "pending" by default
  window.onload = () => loadTable('pending');