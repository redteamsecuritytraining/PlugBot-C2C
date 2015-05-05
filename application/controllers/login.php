<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function index()
    {
        /*
         * Display the login page
         */
        
        $this->load->view('login_view');
        $this->session->sess_destroy();
    }

    function doLogin()
    {
        /* 
         * Process the user login request
         */
        
        // Get clean info from login form
        $username = xss_clean(trim($this->input->post('username')));
        $password = xss_clean(trim($this->input->post('password')));

        // Validate username/password
        $query = $this->user_model->validateCreds($username, $password);

        if($query) // if the user's credentials validated...
        {
            $data = array(
                'is_logged_in'  => true,
                'username'      => $username
            );

            // Save session data
            $this->session->set_userdata($data);

            // Log action
            $this->log_model->log_checkin('001', '55', 'C&C: User logged in');

            // Forward to the main config page
            redirect('login/manage');
        }
            else // incorrect username or password
        {
            // Log action
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Invalid login attempt!');

            // Invalid login, display msg
            $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR: </span> Invalid username or password! </div>');
            redirect(base_url());
        }
    }

    function manage()
    {
        /*
         * Displays the manage page
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Get log data for the header
        $data_graph['bot_data'] = $this->bot_model->getBotData();
        $data_graph['bot_count'] = $this->bot_model->countBots();

        $this->load->view('includes/header.php');
        $this->load->view('manage_main_view', $data_graph);
        $this->load->view('includes/footer.php');
    }

    function about()
    {
        /*
         * Displays the about page
         */
        
        // Security check
        $this->_is_logged_in();

        $this->load->view('includes/header.php');
        $this->load->view('manage_about_view');
    }

    function license()
    {
        /*
         * Displays the license page
         */
        
        // Security check
        $this->_is_logged_in();

        $this->load->view('includes/header.php');
        $this->load->view('manage_license_view');
    }

    function viewlogs()
    {
        /*
         * Displays the logs page
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Help
        $data['help'] = $this->plugbot_model->setHelp();
        
        // Token
        $logs['token'] = $this->_secToken();

        // Pagination stuff
        $config['base_url'] = base_url().'login/viewlogs/';
        $config['total_rows'] = $this->db->get('tblLog')->num_rows();
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['per_page'] = 10;
        $config['num_links'] = 9;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        // log data
        $this->db->order_by('log_date','desc');
        $logs['log_entry'] = $this->db->get('tblLog', $config['per_page'], $this->uri->segment(3));

        $this->load->view('includes/header.php', $data);
        $this->load->view('manage_viewlogs_view', $logs);
    }

    function viewlogsnci()
    {
        /* 
         * Displays all non checkin logs
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Help
        $data['help'] = $this->plugbot_model->setHelp();
        
        // Token
        $logs['token'] = $this->_secToken();

        // Pagination stuff
        $config['base_url'] = base_url().'login/viewlogsnci/';
        $config['total_rows'] = $this->log_model->countNCILogs(); // Count records, without CHECK-INs
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['per_page'] = 10;
        $config['num_links'] = 9;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        // log data, without CHECK-INs
        $this->db->not_like('log_type', '200');
        $this->db->order_by('log_date','desc');
        $logs['log_entry'] = $this->db->get('tblLog', $config['per_page'], $this->uri->segment(3));

        $this->load->view('includes/header.php', $data);
        $this->load->view('manage_viewlogsnci_view', $logs);
    }

    function stopbot()
    {
        /* 
         * Displays the stop bot page
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Help
        $data['help'] = $this->plugbot_model->setHelp();

        // Token
        $token['token'] = $this->_secToken();

        // Get bots
        $data['bot_data'] = $this->bot_model->getBotData();

        // Get log data
        $data['stopbot_data'] = $this->log_model->getAllStopBots();

        $this->load->view('includes/header.php', $data);
        $this->load->view('manage_stopbot_view', $token);
    }

    function doStopBot()
    {
        /*
         * Processes the stop bot request
         */
        
        // Security check
        $this->_is_logged_in();
        
        $botkey = xss_clean(trim($this->input->post('bot_key')));
        $token = xss_clean(trim($this->input->post('token')));

        if ($this->input->post('token') == $this->session->userdata('token'))
        {
            if ($botkey)
            {
                $this->scheduler_model->stopBot($botkey);
                $this->log_model->log_checkin($botkey,'99','SCHEDULE: A request has been made to stop the bot.');
                $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> A request to stop the Bot has been made </div>');
                redirect('login/stopbot');
            } else {
                $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR! </span> Please select a Bot to stop </div>');
                redirect('login/stopbot');
            }
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }
    
    function changePwd()
    {
        /*
         * Displays the change password page
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Help
        $data['help'] = $this->plugbot_model->setHelp();

        // Token
        $token['token'] = $this->_secToken();

        $this->load->view('includes/header.php', $data);
        $this->load->view('manage_chgpwd_view', $token);
    }

    function sethelp()
    {
        /* 
         * Displays the set help page
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Help
        $data['help'] = $this->plugbot_model->setHelp();

        // Token
        $token['token'] = $this->_secToken();

        $this->load->view('includes/header.php', $data);
        $this->load->view('manage_sethelp_view', $token);
    }

    function managejobs()
    {
        /*
         * Displays the manage jobs page
         */
        
        // Security check
        $this->_is_logged_in();

        // Help
        $data['help'] = $this->plugbot_model->setHelp();

        // Token
        $jobs['token'] = $this->_secToken();

        // Pagination stuff
        $config['base_url'] = base_url().'login/managejobs/';
        $config['total_rows'] = $this->db->get('tblJob')->num_rows();
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['per_page'] = 10;
        $config['num_links'] = 4;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        // Job data
        $this->db->order_by('job_date','desc');
        $jobs['job_data'] = $this->db->get('tblJob', $config['per_page'], $this->uri->segment(3));

        $this->load->view('includes/header.php', $data);
        $this->load->view('manage_managejobs_view', $jobs);
    }

    function manageapps()
    {
        /* 
         * Displays the manage apps page
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Help
        $data['help'] = $this->plugbot_model->setHelp();

        // Token
        $apps['token'] = $this->_secToken();

        // Pagination stuff
        $config['base_url'] = base_url().'login/manageapps/';
        $config['total_rows'] = $this->db->get('tblApp')->num_rows();
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['per_page'] = 10;
        $config['num_links'] = 4;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        // App data
        $this->db->order_by('app_botid','asc');
        $this->db->order_by('app_name','asc');
        $apps['app_data'] = $this->db->get('tblApp', $config['per_page'], $this->uri->segment(3));

        $this->load->view('includes/header.php', $data);
        $this->load->view('manage_manageapps_view', $apps);
    }

    function managebots()
    {
        /*
         * Displays the manage bots page
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Help
        $data['help'] = $this->plugbot_model->setHelp();

        // Token
        $token['token'] = $this->_secToken();
        
        // Get all jobs
        $data['bot_data'] = $this->bot_model->getAllBots();

        $this->load->view('includes/header.php', $data);
        $this->load->view('manage_managebots_view', $token);
    }

    function doChangePassword()
    {
        /* 
         * Processes the password change request
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Get POST data and cleanse
        $password = xss_clean(trim($this->input->post('password')));
        $new_password = xss_clean(trim($this->input->post('new_password')));
        $token = xss_clean(trim($this->input->post('token')));

        if ($this->input->post('token') == $this->session->userdata('token'))
        {
            // Verify passwords
            if ($password == $new_password AND $password != '' AND $new_password != '')
            {
                // Change password
                $this->user_model->doChangePwd($password);

                // Notify user
                $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> Password saved </div>');
                redirect('login/changePwd');
            } else {
                // Error
                $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR: </span> Password mismatch or empty fields </div>');
                redirect('login/changePwd');
            }
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }

    function addjob()
    {
        /*
         * Displays the add job page
         */
        
        // Security check
        $this->_is_logged_in();

        // Help
        $data['help'] = $this->plugbot_model->setHelp();

        // Get bots
        $data['bot_data'] = $this->bot_model->getBotData();

        // Token
        $token['token'] = $this->_secToken();

        $this->load->view('includes/header.php', $data);
        $this->load->view('manage_jobadd_view',$token);
    }
    
    function addapp()
    {
        /*
         * Displays the add app page
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Help
        $data['help'] = $this->plugbot_model->setHelp();

        // Get bots
        $data['bot_data'] = $this->bot_model->getBotData();

        // Token
        $token['token'] = $this->_secToken();

        $this->load->view('includes/header.php', $data);
        $this->load->view('manage_appadd_view', $token);
    }

    function addbot()
    {
        /*
         * Displays the add bot page
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Help
        $data['help'] = $this->plugbot_model->setHelp();

        // Get bots
        $data['bot_data'] = $this->bot_model->getBotData();

        // Token
        $token['token'] = $this->_secToken();

        $this->load->view('includes/header.php', $data);
        $this->load->view('manage_botadd_view', $token);
    }

    function delApp($id)
    {
        /*
         * Processes the delete app request
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Get token from URI
        $token = trim(xss_clean($this->uri->segment(4)));

        if ($token == $this->session->userdata('token'))
        {
            if ($id)
            {
                $this->app_model->delApp($id);
                $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> Application was deleted </div>');
                redirect('login/manageapps');
            } else {
                $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR! </span> Unable to delete app! </div>');
                redirect('login/managejobs');
            }
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }

    function delBot($id)
    {
        /*
         * Processes the delete bot request
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Get token from URI
        $token = trim(xss_clean($this->uri->segment(4)));

        if ($token == $this->session->userdata('token'))
        {
            if ($id)
            {
                $this->bot_model->delBot($id);
                $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> Bot was deleted </div>');
                redirect('login/managebots');
            } else {
                $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR! </span> Unable to delete Bot! </div>');
                redirect('login/managebots');
            }
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }

    function delJobs()
    {
        /*
         * Deletes all jobs
         */
        
        // Security check
        $this->_is_logged_in();
        
        $token = xss_clean(trim($this->input->post('token')));

        if ($this->input->post('token') == $this->session->userdata('token'))
        {
            // Empty the job table
            $this->job_model->delAllJobs();

            $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> The job table has been cleared! </div>');
            redirect('login/managejobs');
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }
    
    function delLogs()
    {
        /*
         * Deletes all logs
         */
        
        // Security check
        $this->_is_logged_in();
        
        $token = xss_clean(trim($this->input->post('token')));

        if ($this->input->post('token') == $this->session->userdata('token'))
        {
            // Truncate the Log table
            $this->log_model->delLogs();

            $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> The log table has been cleared! </div>');
            redirect('login/viewlogs');
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }

    function delLogsNCI()
    {
        /*
         * Deletes all logs
         */
        
        // Security check
        $this->_is_logged_in();
        
        $token = xss_clean(trim($this->input->post('token')));

        if ($this->input->post('token') == $this->session->userdata('token'))
        {
            // Truncate the Log table
            $this->log_model->delLogs();

            $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> The log table has been cleared! </div>');
            redirect('login/viewlogsnci');
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }

    function doChangeHelp()
    {
        /* 
         * Processes the request to modify the help setting
         */
        
        // Security check
        $this->_is_logged_in();
        
        $set_help = xss_clean(trim($this->input->post('set_help')));
        $token = xss_clean(trim($this->input->post('token')));

        if ($this->input->post('token') == $this->session->userdata('token'))
        {
            // Process request
            if ($set_help != '')
            {
                $set_help = 1;
                // Change the DB
               $this->plugbot_model->changeHelp($set_help);
               $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> Help setting has been saved </div>');
               redirect('login/sethelp');
            }

            if ($set_help == '')
            {
                $set_help = 0;
               $this->plugbot_model->changeHelp($set_help);
               $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> Help setting has been saved </div>');
               redirect('login/sethelp');
            }           
               
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }

    function doAddJob()
    {
        /*
         * Processes the add job request 
         */
        
        // Security check
        $this->_is_logged_in();
        
        $job_name = xss_clean(trim($this->input->post('job_name')));
        $job_botkey = xss_clean(trim($this->input->post('job_botkey')));
        $job_app_random = xss_clean(trim($this->input->post('job_app_random')));
        $job_command = xss_clean(trim($this->input->post('job_command')));
        $job_output = $this->input->post('job_output'); // how the output will be handled
        $job_random = mt_rand();
        $job_status = '1'; // Status of 1 = new job to be picked up by bot
        $token = xss_clean(trim($this->input->post('token')));

        if ($this->input->post('token') == $this->session->userdata('token'))
        {
            // Process request
            if ($job_name != '' AND $job_botkey != '' AND $job_app_random != '' AND $job_command != '' AND $job_output != '' AND $job_random != '' AND $job_status != '')
            {
                // Add to db
                $this->job_model->addJob($job_name, $job_botkey, $job_app_random, $job_random, $job_status, $job_command, $job_output);
                $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> Job was added </div>');
                redirect('login/addjob');
            } else {
                // Error
                $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR! </span> All fields are required </div>');
                redirect('login/addjob');
            }
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }

    function doAddBot()
    {
        /*
         * Processes the add bot request
         */
        
        // Security check
        $this->_is_logged_in();
        
        $bot_key = xss_clean(trim($this->input->post('bot_key')));
        $bot_privatekey = xss_clean(trim($this->input->post('bot_privatekey')));
        $bot_name = xss_clean(trim($this->input->post('bot_name')));
        $addapps = xss_clean(trim($this->input->post('addapps')));
        $token = xss_clean(trim($this->input->post('token')));

        if ($this->input->post('token') == $this->session->userdata('token'))
        {
            // Process request
            if ($bot_key AND $bot_name AND $bot_privatekey)
            {
                if (!$this->bot_model->validateBot($bot_key))
                {
                    // Add to db
                    $this->bot_model->addBot($bot_name, $bot_privatekey, $bot_key);

                    // Add Pre-installed apps per user request
                    if ($addapps)
                    {
                        // Add pre-installed records to the apps table
                        $this->app_model->addPreinstallApps($bot_key);
                    }

                    $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> Bot was added </div>');
                    redirect('login/addbot');                    
                } else {
                    // Error
                    $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR! </span> That botkey already exists! </div>');
                    redirect('login/addbot');                    
                }
            } else {
                // Error
                $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR! </span> All fields are required </div>');
                redirect('login/addbot');
            }
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }


    function doAddApp()
    {
        /*
         * Process the add app request
         */
        
        // Security check
        $this->_is_logged_in();
        
        $app_botkey = xss_clean(trim($this->input->post('app_botid')));
        $app_name = xss_clean(trim($this->input->post('app_name')));
        $app_description = xss_clean(trim($this->input->post('app_description')));
        $app_download = xss_clean(trim($this->input->post('app_download')));
        $app_file = xss_clean(trim($this->input->post('app_file')));
        $app_interactive = xss_clean(trim($this->input->post('app_interactive')));
        $app_exec = xss_clean(trim($this->input->post('app_exec')));
        $app_random = mt_rand();
        $app_status = '1'; // Status of 1 = new app to be picked up by bot
        $token = xss_clean(trim($this->input->post('token')));

        if ($this->input->post('token') == $this->session->userdata('token'))
        {

            // Process request
            if ($app_name != '' AND $app_botkey != '' AND $app_description != '' AND $app_download != '' AND $app_file != '' AND $app_interactive != '' AND $app_exec != '' AND $app_random != '' AND $app_status != '')
            {
                // Add to db
                $this->app_model->addApp($app_botkey, $app_name, $app_description, $app_download, $app_file, $app_interactive, $app_exec, $app_random, $app_status);
                $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> Application was added </div>');
                redirect('login/addapp');
            } else {
                // Error
                $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR! </span> Unable to add application </div>');
                redirect('login/addapp');
            }
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }


    function ajaxgetapp()
    {
        /*
         * This method is used on the Add Job page
         * and is used in the second drop down
         *
         * An ajax call in functions.js calls this
         */

        // Security check
        $this->_is_logged_in();
        
        // Get botkey from URI
        $id = trim(xss_clean($this->uri->segment(3)));

        if ($id)
        {
            $data['app_data'] = $this->app_model->getAllApps($id);            
            $this->load->view('manage_ajax_app_view', $data);
        } else {
            $this->load->view('manage_ajax_nothing_view');
        }
    }

    function ajaxgetcmd()
    {
        /*
         * This method is used on the Add Job page
         * and is used in the job command text box
         *
         * An ajax call in functions.js calls this
         */

        // Security check
        $this->_is_logged_in();
        
        // Get botkey from URI
        $app_random = trim(xss_clean($this->uri->segment(3)));

        if ($app_random)
        {
            $data['app_data'] = $this->app_model->getAppCmd($app_random);
            $this->load->view('manage_ajax_cmd_view', $data);
        } else {
            $this->load->view('manage_ajax_nothing_view');
        }
    }

    function ajaxgetinteractive()
    {
        /*
         * This method is used on the Add Job page
         * and is used in the job command text box
         *
         * An ajax call in functions.js calls this
         */

        // Security check
        $this->_is_logged_in();
        
        // Get botkey from URI
        $app_random = trim(xss_clean($this->uri->segment(3)));

        if ($app_random)
        {
            $data['app_data'] = $this->app_model->getAppInteractive($app_random);
            $this->load->view('manage_ajax_interactive_view', $data);
        } else {
            $this->load->view('manage_ajax_nothing_view');
        }
    }

    function delJob($id)
    {
        /*
         * Deletes a job 
         */
        
        // Security check
        $this->_is_logged_in();
        
        // Get token from URI
        $token = trim(xss_clean($this->uri->segment(4)));

        if ($token == $this->session->userdata('token'))
        {
            if ($id)
            {
                $this->job_model->delJob($id);
                $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> Job was deleted </div>');
                redirect('login/managejobs');
            } else {
                $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR! </span> Unable to delete job! </div>');
                redirect('login/managejobs');
            }
        } else {
            // CSRF?
            $this->log_model->log_checkin('001', '69', 'C&C ERROR: Detected a potential CSRF attack!');
            redirect(base_url());
        }
    }

    function editjob()
    {
        // Load view for pending jobs
        $this->_is_logged_in();
        $id = trim(xss_clean($this->uri->segment(3)));

        if ($id)
        {
            // Get bots
            $data['bot_data'] = $this->bot_model->getBotData();

            // Get job data for editing
            $query = $this->job_model->getJobEdit($id);
            
            if ($query)
            {
                $q = $query->row();
                $data['job_name'] = $q->job_name;
                $data['job_command'] = $q->job_command;

                // Get bot name and app
                $data['bot_name'] = $this->bot_model->getBotName($q->job_botkey);
                $data['bot_key'] = $q->job_botkey;

                // Get app name and app_random
                $data['app_name'] = $this->app_model->getAppName($q->job_app_random);
                $data['app_random'] = $q->job_app_random;
                $data['app_output'] = $q->job_output;

                $this->load->view('includes/header.php', $data);
                $this->load->view('manage_editjob_view');
            } else {
                $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR! </span> Error getting job details! </div>');
                redirect('login/managejobs');
            }
        } else {
            $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR! </span> Error getting job details! </div>');
            redirect('login/managejobs');
        }
        
    }

    function doUpdateJob()
    {
        /*
         * Processes the request to update the job
         */
        
        // Security check
        $this->_is_logged_in();
        $id = trim(xss_clean($this->uri->segment(3)));
        
        $job_name = xss_clean(trim($this->input->post('job_name')));
        $job_botkey = xss_clean(trim($this->input->post('job_botkey')));
        $job_app_random = xss_clean(trim($this->input->post('job_app_random')));
        $job_command = xss_clean(trim($this->input->post('job_command')));
        $job_output = xss_clean(trim($this->input->post('job_output')));
        $job_random = mt_rand();
        $job_status = '1'; // Status of 1 = new job to be picked up by bot

        // Process request
        if ($id != '' AND $job_name != '' AND $job_botkey != '' AND $job_app_random != '' AND $job_command != '' AND $job_random != '' AND $job_output != '' AND $job_status != '')
        {
            $this->job_model->updateJob($id, $job_name, $job_botkey, $job_app_random, $job_random, $job_status, $job_command, $job_output);
            $this->session->set_flashdata('messages', '<div class="notification success"><span class="strong">SUCCESS! </span> New job settings were saved </div>');
            redirect('login/managejobs');
        } else {
            $this->session->set_flashdata('messages', '<div class="notification error"><span class="strong">ERROR! </span> Unable to update job! </div>');
            redirect('login/managejobs');
        }

    }

    function viewoutput($id)
    {
        /*
         * Displays the job output  
         */
        
        // Security check
        $this->_is_logged_in();

        // Get id from the URI
        $id = trim(xss_clean($this->uri->segment(3)));

        // Validate job
        $job = $this->job_model->validateJob($id);
        
        if ($job)
        {
            //Get output from job
            $query = $this->job_model->getJobOutput($id);

            if ($query)
            {
                $q = $query->row();
                $data['job_date'] = $q->job_date;
                $data['job_name'] = $q->job_name;
                $data['job_output'] = $q->job_output;
                $data['job_command'] = $q->job_command;

                // Get log data for the header
                 $this->load->view('includes/header.php', $data);
                 $this->load->view('manage_viewoutput_view');
            }  
        } else {
            echo 'Nothing to see...';
        }
    }

    function logout()
    {
        /*
         * Provides the logout function to the user
         */
        
        // Security check
        $this->_is_logged_in();        
        
        // Log action
        $this->log_model->log_checkin('001', '75', 'C&C: User logged out');

        $this->session->set_flashdata('messages', '<div class="notification info"><span class="strong">INFO: </span> You have been logged out </div>');
        redirect(base_url());
    }

    function ajaxstatus()
    {
        /*
         * Updates the job status on the manage jobs page
         */
        
        // Security check
        $this->_is_logged_in();

        $id = trim(xss_clean($this->uri->segment(3)));
        $data['status'] = $this->job_model->getStatus($id);

        $this->load->view('manage_ajaxstatus_view.php', $data);
    }

    function ajaxactions()
    {
        /*
         * Updates the job actions on the manage jobs page
         */

        // Security check
        $this->_is_logged_in();
        
        // Token
        $data['token'] = $this->session->userdata('token');

        $id = trim(xss_clean($this->uri->segment(3)));
        $data['status'] = $this->job_model->getStatus($id);
        $data['id'] = $id;

        $this->load->view('manage_ajaxactions_view.php', $data);
    }

    function ajaxappstatus()
    {
        /*
         * UPdates the app installation progress from the manage apps page
         */
        $this->_is_logged_in();

        // Token
        $data['token'] = $this->session->userdata('token');

        $id = trim(xss_clean($this->uri->segment(3)));
        $data['status'] = $this->app_model->getStatus($id);

        $this->load->view('manage_ajaxappstatus_view.php', $data);
    }

    function ajaxappactions()
    {
         /*
         * Updates the app actions on the manage apps page
         */

        $this->_is_logged_in();

        // Token
        $data['token'] = $this->session->userdata('token');

        $id = trim(xss_clean($this->uri->segment(3)));
        $data['status'] = $this->app_model->getStatus($id);
        $data['id'] = $id;

        $this->load->view('manage_ajaxappactions_view.php', $data);
    }

    private function _is_logged_in()
    {
        /*
         * Security checker for valid session 
         */
        
        // Get the value from the session, if there
        $is_logged_in = $this->session->userdata('is_logged_in');
        
        if(!isset($is_logged_in) || $is_logged_in != true)
        {
            /* 
             * User not logged in, session has expired or they're 
             * trying to force browse the site
             */
           
            // Oops...
            $this->session->set_flashdata('messages', '<div class="notification warning"><span class="strong">WARNING: </span> Access is restricted! </div>');
            redirect(base_url());
        }
    }  
    
    function _secToken()
    {
        /*
         * Generate unique security token
         */
        
        // Gen token
        $token = md5(uniqid(mt_rand(), true));
        
        $data = array(
            'token'  =>  $token
        );

        // Save session data
        $this->session->set_userdata($data);
        return $token;
    }    
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */