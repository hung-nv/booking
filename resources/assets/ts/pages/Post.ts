import Page from "../systems/page";

import {slugify, doException} from "../utilities/common/helpers";
import {initInputImage, newInputImage} from "../utilities/image/image";

declare let $;
declare let viewData;
declare let toastr;

const ui = {
    inputImage: '#image',
    inputOldImage: '#old-image',
    urlDeleteImage: '/api/post/delete-image',
    inputRemoveInitPreview: '.kv-file-remove'
};

export default class Post extends Page {
    public postName: string = viewData.oldName;

    public postSlug: string = viewData.oldSlug;

    /**
     * An object where keys are expressions to watch and values are the corresponding callbacks.
     * @type {{postName: (newValue, oldValue) => void}}
     */
    watch = {
        postName: function (newValue, oldValue) {
            this.postSlug = slugify(newValue);
        }
    };

    public setUp() {
        this.setInputImage();
    }

    /**
     * Set input image preview.
     */
    public setInputImage() {
        if ($(ui.inputImage).length) {
            if ($(ui.inputOldImage).length) {
                initInputImage(
                    ui.inputOldImage,
                    ui.inputImage,
                    ui.urlDeleteImage
                );
            } else {
                newInputImage(ui.inputImage);
            }
        }

        $(ui.inputImage).on('fileclear', function (event) {
            $(ui.inputRemoveInitPreview).trigger("click");
        });
    }

    public addGroup(element) {
        let groupId, groupName, postId;

        groupId = $(element).data('group-id');
        groupName = $(element).data('group-name');
        postId = $(element).data('post-id');

        if(groupId === undefined || groupName === undefined || postId === undefined) {
            return;
        }

        $.ajax({
            type: "post",
            dataType: 'json',
            url: '/api/post/add-group',
            headers: {
                Accept: 'application/json'
            },
            data: {
                post_id: postId,
                group_id: groupId,
                group_name: groupName
            }
        }).done(respon => {
            toastr.info(respon.message);

            this.createContainerChecked($(element));
        }).fail(xhr => {
            doException(xhr);
        });
    }

    public removeGroup(element) {
        let groupId, groupName, postId;

        groupId = $(element).data('group-id');
        groupName = $(element).data('group-name');
        postId = $(element).data('post-id');

        if(groupId === undefined || groupName === undefined || postId === undefined) {
            return;
        }

        $.ajax({
            type: "post",
            dataType: 'json',
            url: '/api/post/remove-group',
            data: {
                post_id: postId,
                group_id: groupId,
                group_name: groupName
            }
        }).done(respon => {
            toastr.warning(respon.message);

            this.createContainerSet($(element));
        }).fail(xhr => {
            doException(xhr);
        });
    }

    private createContainerChecked(container) {
        let iconCheck, buttonCheck, buttonRemove, iconRemove, wrapContainer;

        iconCheck = $('<i>').addClass('fa fa-check');
        buttonCheck = $('<a>').addClass('btn btn-xs blue');
        buttonRemove = $('<a>').addClass('btn btn-xs red')
            .attr('data-group-id', container.data('group-id'))
            .attr('data-group-name', container.data('group-name'))
            .attr('data-post-id', container.data('post-id'))
            .attr('onclick', 'mainComponent.removeGroup(this)');
        iconRemove = $('<i>').addClass('fa fa-times');
        buttonCheck.append(iconCheck).append(' ' + container.data('group-name'));
        buttonRemove.append(iconRemove);

        wrapContainer = container.parent();
        wrapContainer.html('');
        wrapContainer.append(buttonCheck)
            .append(buttonRemove);
    }

    private createContainerSet(container) {
        let wrapContainer, buttonSetGroup;

        wrapContainer = container.parent();

        buttonSetGroup = $('<button>').addClass('btn btn-xs grey-cascade')
            .attr('data-group-id', container.data('group-id'))
            .attr('data-group-name', container.data('group-name'))
            .attr('data-post-id', container.data('post-id'))
            .attr('onclick', 'mainComponent.addGroup(this)')
            .text('Set to "' + container.data('group-name') + '"');
        wrapContainer.html('');
        wrapContainer.append(buttonSetGroup)
    }
}