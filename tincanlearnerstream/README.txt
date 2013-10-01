Tin Can Learner Stream
==============================

A block to display a learner's Tin Can activity stream

##Background
The [Tin Can API specification](https://www.tincanapi.co.uk) was released in April 2013 as a replacement for SCORM. 
Tin Can allows for tracking of any learning experience. Tin Can was designed on the premise of a distributed system
communicating via API calls over the internet. This means that whislt it is possible to include a Learner Record 
Store (LRS) and reporting tools inside an LMS like Moodle, it is equally possible for the LRS and reporting tools
to exist as seprate entities outside of the LMS.

This is the second of a series of small bite-sized projects to add Tin Can capability to Moodle. These projects will 
assume that a seprate LRS and reporting tools will be used. This will allow us to take advantage of open source 
Tin Can LRS and reporting tool projects outside of the Moodle community. This first project will deal with 
launching Tin Can e-learning from Moodle.

This project provides a basic learner-centered reporting tool as a block. It allows an indidvidual learner to see their most
recent Tin Can tracked activity. It's intended more as a proof of concept than a final product at this stage and could
provide a launch pad for further Tin Can reporting or social sharing of learning embedded within Moodle. 

##What you will need

To use this plugin you will need the following:

* Moodle 2.5 fully set up and running on a server that you have ftp access to 
* Login details for the admin account 
* Any Tin Can enabled activty provider (e.g. a piece of Tin Can enabled e-learning)
* A Tin Can compliant LRS (this plugin has been tested with Wax and SCORM Cloud) 
* A Tin Can compliant reporting tool 
* A copy of this plugin.

##Installation

This plugin is installed in the same way as any block. Simply drop the tincanlearnerstream folder into your 
mod folder on your moodle and then install via system administration as normal.

**WARNING:** Some users have experienced issues with installing my plugins by using Moodle's
addon installer in the admin interface. This method of installion is not currently supported.

###Add the block to a page or course 

This block can be added to a course like any other block. Simply add a block and select Tin Can Learner Stream from the list.

The block will display the most recent statements for the current user stored in the LRS specified in the block settings. 

The settings for this block all have help text which can be accessed by clicking the ? icon next to that setting. 
I don't intend to repeat that information here. If any of the help text is unclear, then please raise an issue here 
and suggest an improvement.



##FAQ
So far nobody has asked any questions, but here's some I imagine people might ask:

###Where does the tracking data come from?
Tracking data from learning activities is stored in your LRS and retrieved by the plugin.

It may be that a reporting tool plugin for Moodle is developed in future, or you could write your own.

###On my Moodle, all/some of my users have the same dummy email address. The plugin is behaving oddly. 

The plugin tells the e-learning to store data based on the learner's email address as stored in moodle. It's therefore 
important that the Moodle email address is unique for each user, not just within the scope of the Moodle, but within 
the scope of any system where the tracking data is used or will be used in the future. The safest best is to ensure 
it's universally unique.

With a little work, the plugin can be modified to use the Moodle account id instead.

###Why doesn't the plugin do x y and z?
If you'd like the plugin to do something, please raise an issue and perhaps somebody will do it for you for free. 
If you want to make sure it happens, or get it done quickly, I recommended you hire a developer or add the feature 
yourself. Email [mrdownes@hotmail.com](mailto:mrdownes@hotmail.com) if you'd like to hire me.

###I'm developing a piece of e-learning or authoring tool and want to make sure it will work with Moodle
Great! Please get in touch if you have any questions or want to hire a Tin Can expert. 
[mrdownes@hotmail.com](mailto:mrdownes@hotmail.com)