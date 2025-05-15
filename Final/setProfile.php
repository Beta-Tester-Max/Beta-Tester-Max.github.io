<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Completion Form</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/AICS150.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/form.css" />
    
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Kindly Complete your profile so you can apply for assistance</h2>
        
        <div class="form-container">
            <div class="form-section">
                <div class="form-header">Family Information</div>
                
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" placeholder="Family Name">
                    </div>
                    <div class="form-group">
                        <input type="number" id="num-members" placeholder="Number of members" min="1" onchange="updateFamilyComposition()">
                    </div>
                    <div class="form-group">
                        <select>
                            <option>Type of Family</option>
                            <option>Extended</option>
                            <option>Nuclear</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-section">
                <div class="form-row">
                    <div class="form-group">
                        <div class="form-header">Address</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" placeholder="Street">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Barangay">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="City">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Province">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" placeholder="Region">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Zip Code">
                    </div>
                </div>
            </div>
            
            <div class="form-section">
                <div class="form-header">Family Composition</div>
                
                <div class="relationship-options">
                    Select from the dropdown to specify relationship
                </div>
                
                <table class="family-composition-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>BirthDate</th>
                            <th>Relationship</th>
                            <th>Vital Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="family-members">
                        <!-- Rows will be added here based on number of members -->
                    </tbody>
                </table>
                
                <div class="add-member">
                    <button onclick="addFamilyMember()">Add Member</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script>
        function updateFamilyComposition() {
            const numMembers = parseInt(document.getElementById('num-members').value) || 1;
            const familyMembersTable = document.getElementById('family-members');
            familyMembersTable.innerHTML = '';
            
            for (let i = 0; i < numMembers; i++) {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="text" placeholder="Name" required></td>
                    <td>
                        <input type="text" class="birthdate-picker" placeholder="Select Birthdate" required>
                        <span class="delete-icon" onclick="deleteRow(this)">🗑️</span>
                    </td>
                    <td>
                        <select required>
                            <option>Select Relationship</option>
                            <option>Sibling: Brother</option>
                            <option>Sibling: Sister</option>
                            <option>Child: Son</option>
                            <option>Child: Daughter</option>
                            <option>Nibling: Nephew</option>
                            <option>Nibing: Niece</option>
                            <option>Spouse: Wife</option>
                            <option>Spouse: Husband</option>
                        </select>
                    </td>
                    <td>
                        <select required>
                            <option>Vital Status</option>
                            <option>Alive</option>
                            <option>Deceased</option>
                        </select>
                    </td>
                    <td></td>
                `;
                familyMembersTable.appendChild(row);
                initializeCalendar(row);
            }
        }

        function addFamilyMember() {
            const familyMembersTable = document.getElementById('family-members');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input type="text" placeholder="Name"></td>
                <td>
                    <input type="text" class="birthdate-picker" placeholder="Select Birthdate">
                </td>
                <td>
                    <select>
                        <option>Select Relationship</option>
                        <option>Sibling: Brother</option>
                        <option>Sibling: Sister</option>
                        <option>Child: Son</option>
                        <option>Child: Daughter</option>
                        <option>Nibling: Nephew</option>
                        <option>Nibing: Niece</option>
                        <option>Spouse: Wife</option>
                        <option>Spouse: Husband</option>
                    </select>
                </td>
                <td>
                    <select>
                        <option>Vital Status</option>
                        <option>Alive</option>
                        <option>Deceased</option>
                    </select>
                </td>
                <td> <span class="delete-icon" onclick="deleteRow(this)">🗑️</span></td>
            `;
            familyMembersTable.appendChild(row);
            initializeCalendar(row);
        }

        function deleteRow(element) {
            var row = element.closest('tr');
            row.remove();
        }

        function initializeCalendar(row) {
            const birthdatePicker = row.querySelector('.birthdate-picker');
            if (birthdatePicker) {
                flatpickr(birthdatePicker, {
                    dateFormat: "m-d-Y",
                    maxDate: "today"
                });
            }
        }
    </script>
</body>
</html>