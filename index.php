<?php
/**
 * This code retrieves course data from an external API and displays it in the user's
 * My Account area. A merchant has noticed that there's a delay when loading the page.
 *
 * == What changes would you suggest to reduce or remove that delay? ==
 */

/**
 * Created by PhpStorm.
 * User: prashantsingh
 * Date: 18/05/20
 * Time: 9:21 AM
 */
define('__API_URL__', 'http://sampleapi.com');
require 'user.php';

class sample_php extends user
{
    var $current_user;

    function __construct()
    {
        parent::__construct();
    }

    public function add_my_courses_section()
    {

        $this->current_user->ID = (isset($_GET['user_id']) && $_GET['user_id'] > 0 ? $_GET['user_id'] : 0);
        $api_user_id = $this->get_user_meta($this->current_user->ID, '_external_api_user_id', true);

        if (!$api_user_id) {
            return false;
        } else {
            $res = $this->get_api()->get_courses_assigned_to_user($api_user_id)->get_sso_link($api_user_id);
            $courses = $res->RESULT['courses'];
            $sso_link = $res->RESULT['link'];
            ?>
            <h2 style="margin-top: 40px;"><?php echo 'My Courses'; ?></h2>
            <table>
            <thead>
            <tr>
                <th><?php echo 'Course Code'; ?></th>
                <th><?php echo 'Course Title'; ?></th>
                <th><?php echo 'Completion'; ?></th>
                <th><?php echo 'Date Completed'; ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($courses)) {
                foreach ($courses as $course) {
                    ?>
                    <tr>
                        <td><?php echo $course['Code']; ?></td>
                        <td><?php echo $course['Name']; ?></td>
                        <td><?php echo $course['PercentageComplete']; ?> &#37;</td>
                        <td><?php echo $course['DateCompleted']; ?></td>
                    </tr>
                    <?php
                }
            }?>
            </tbody>
            </table>
            <p><a href="<?php echo $sso_link ?>" target="_blank"
                  class="button <?php echo $_GET['active_course']; ?>"><?php echo 'Course Login'; ?></a></p>

            <?php
        }
    }

}
$data = new sample_php();
$data->add_my_courses_section();