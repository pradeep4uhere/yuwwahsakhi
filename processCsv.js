import fs from 'fs';
import readline from 'readline';
import mysql from 'mysql2';

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'password',
    database: 'yuwaahsakhi'
});
connection.connect((err) => {
    if (err) {
        console.error('Error connecting to the database:', err);
    } else {
        console.log('Connected to the database');
    }
});

const processCsv = (filePath,io) => {
    let totalRows = 0;
    let processedRows = 0;
    console.log('Inside processCsv method');
    console.log('filePath: ' + filePath);

    // Normalize date and datetime functions
    const normalizeDate = (date) => {
        if (!date) return '1970-01-01'; // Fallback to default date

        const parsedDate = new Date(date);
        if (isNaN(parsedDate)) return '1970-01-01'; // Fallback on invalid date

        const year = parsedDate.getFullYear();
        const month = String(parsedDate.getMonth() + 1).padStart(2, '0');
        const day = String(parsedDate.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };

    const normalizeDatetime = (datetime) => {
        if (!datetime) return '1970-01-01 00:00:00'; // Default value if no datetime is provided
    
        // If the datetime is in ISO format, remove the 'Z' and convert to MySQL format
        const date = new Date(datetime);
        if (isNaN(date.getTime())) return '1970-01-01 00:00:00'; // Fallback if invalid datetime
    
        // Format the date to 'YYYY-MM-DD HH:MM:SS'
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
    
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    };
    



    

    const normalizeResumeTimeDatetime = (datetime) => {
        // If datetime is falsy (null, undefined, etc.), return a default value
        if (!datetime || datetime === '21000') return '1970-01-01 00:00:00'; // Fallback if datetime is '21000' or falsy
        
        // Use a regular expression to strip out microseconds and timezone
        const cleanedDatetime = datetime.replace(/\.\d+([+-]\d{2}:?\d{2})?$/, '');
        
        // Ensure the datetime is in 'YYYY-MM-DD HH:MM:SS' format
        const date = new Date(cleanedDatetime);
        
        // Check if the date is valid
        if (isNaN(date.getTime())) {
            return '1970-01-01 00:00:00'; // Fallback in case of an invalid date
        }
        
        // Format it as 'YYYY-MM-DD HH:MM:SS'
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
        
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    };

    // Insert row into database
    const insertRow = (data) => {
        const query = 'INSERT INTO learners (' +
            'account_login_id, first_name, last_name, date_of_birth, gender, experiance, current_job_title, current_company_name, ' +
            'email, primary_email, primary_phone_number, secondary_phone_number, preferred_job_domain1, preferred_job_domain2, ' +
            'preferred_job_domain3, preferred_job_domain4, preferred_mode_of_work, highest_education_qualification, ' +
            'preferred_work_location1, preferred_work_location2, preferred_work_location3, create_date, update_date, ' +
            'last_month_salary, created_at, updated_at' +
            ') VALUES (' +
            '?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?' +
            ')';

        const values = [
            data.account_login_id,
            data.first_name,
            data.last_name,
            normalizeDate(data.date_of_birth),
            data.gender,
            data.experiance,
            data.current_job_title || null,
            data.current_company_name || null,
            data.email || null,
            data.primary_email || null,
            data.primary_phone_number,
            data.secondary_phone_number || null,
            data.preferred_job_domain1 || null,
            data.preferred_job_domain2 || null,
            data.preferred_job_domain3 && data.preferred_job_domain3 !== 'undefined' ? data.preferred_job_domain3 : null,
            data.preferred_job_domain4 || null,
            data.preferred_mode_of_work || null,
            data.highest_education_qualification,
            data.preferred_work_location1 || null,
            data.preferred_work_location2 || null,
            data.preferred_work_location3 && data.preferred_work_location3 !== 'undefined' ? data.preferred_work_location3 : null,
            normalizeResumeTimeDatetime(data.create_date),
            normalizeResumeTimeDatetime(data.update_date),
            data.last_month_salary,
            normalizeDatetime(data.created_at),
            normalizeDatetime(data.updated_at)
        ];

        console.log('SQL Query:', query);
        console.log('Values:', values);
        connection.query(query, values, (err, results) => {
            if (err) {
                console.error('Error inserting row:', err);
            } else {
                processedRows++;
                const progress = Math.floor((processedRows / totalRows) * 100);
                io.emit('progress', { progress }); 
                console.log(`Row ${processedRows} inserted`);
            }
        });
    };

    // Read the CSV file line by line
    const rl = readline.createInterface({
        input: fs.createReadStream(filePath),
        output: process.stdout,
        terminal: false
    });

    rl.on('line', (line) => {
        totalRows++;
        const row = line.split(','); // Split CSV line by comma (adjust if your delimiter is different)
        console.log(line);
        // Extract each value from the CSV row
        const [
            account_login_id,
            first_name,
            date_of_birth,
            gender,
            experiance,
            current_job_title,
            current_company_name,
            primary_email,
            primary_phone_number,
            secondary_phone_number,
            preferred_job_domain1,
            preferred_job_domain2,
            preferred_job_domain3,
            preferred_job_domain4,
            preferred_mode_of_work,
            highest_education_qualification,
            preferred_work_location1,
            preferred_work_location2,
            preferred_work_location3,
            create_date,
            update_date,
            yuwaah_resume_create_date,
            yuwaah_resume_update_date,
            last_month_salary,
            preferred_skill1,
            preferred_skill1_proficiency,
            preferred_skill2,
            preferred_skill2_proficiency,
            preferred_skill3,
            preferred_skill3_proficiency,
            preferred_skill4,
            preferred_skill4_proficiency,
            preferred_skill5,
            preferred_skill5_proficiency,
            current_street,
            current_location_zip,
            career_objective,
            resume_url,
            dont_show_my_profile_to_current_employer,
            receive_email_updates,
            profile_photo_url,
            yuwaah_resume_url,
            profile_visible_to_others,
            additional_link,
            preferred_job_type,
            preferred_industry1,
            preferred_industry2,
            preferred_industry3,
            preferred_work_time,
            app_version_used,
            yuwaah_resume_create_date_revised,
            yuwaah_resume_update_date_revised
        ] = row;

        // Insert the data into the database
        insertRow({
            account_login_id,
            first_name,
            last_name: first_name, // Assuming `last_name` is the same as `first_name`
            date_of_birth,
            gender,
            experiance,
            current_job_title,
            current_company_name,
            email: primary_email,
            primary_email,
            primary_phone_number,
            secondary_phone_number,
            preferred_job_domain1,
            preferred_job_domain2,
            preferred_job_domain3,
            preferred_job_domain4,
            preferred_mode_of_work,
            highest_education_qualification,
            preferred_work_location1,
            preferred_work_location2,
            preferred_work_location3,
            create_date,
            update_date,
            yuwaah_resume_create_date,
            yuwaah_resume_update_date,
            last_month_salary,
            created_at: new Date().toISOString(),
            updated_at: new Date().toISOString(),
        });
    });

    rl.on('close', () => {
        console.log('CSV processing complete');
    });

    return {
        totalRows,
        processedRows
    };
};

export default processCsv;
