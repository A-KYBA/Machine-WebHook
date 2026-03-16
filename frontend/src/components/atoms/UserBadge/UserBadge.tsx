import styles from './UserBadge.module.css';

interface UserBadgeProps {
  username: string;
}

function UserBadge({ username }: UserBadgeProps) {
  return <span className={styles.badge}>{username}</span>;
}

export default UserBadge;
